<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;

class CheckoutController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        $cart = Cart::getOrCreateCart($user->id, session()->getId());
        $cartItems = $cart->items()->with('product')->get();
        $total = $cartItems->sum(fn($item) => $item->quantity * $item->price);

        return view('client.orders.checkout', compact('cartItems', 'total', 'user'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'phone' => 'required',
            'address' => 'required|string',
            'payment_method' => 'required|in:cod,bank_transfer,vnpay,momo',
        ]);

        $user = Auth::user();
        $cart = Cart::getOrCreateCart($user->id, session()->getId());
        $cartItems = $cart->items()->with('product')->get();

        if ($cartItems->isEmpty()) {
            return redirect()->back()->with('error', 'Giỏ hàng của bạn đang trống!');
        }

        $totalAmount = $cartItems->sum(fn($item) => $item->price * $item->quantity);

        // Nếu là thanh toán qua MoMo, thì chuyển hướng
        if ($request->payment_method === 'momo') {
            session([
                'checkout_info' => [
                    'user_id' => $user->id,
                    'name' => $request->name,
                    'phone' => $request->phone,
                    'address' => $request->address,
                    'total' => $totalAmount,
                    'cart_items' => $cartItems->toArray(),
                ]
            ]);
            return $this->momoPayment($totalAmount);
        }

        // Xử lý các phương thức khác
        DB::beginTransaction();
        try {
            $order = Order::create([
                'user_id' => $user->id,
                'status' => 'pending',
                'payment_method' => $request->payment_method,
                'total_amount' => $totalAmount,
            ]);

            foreach ($cartItems as $item) {
                OrderItem::create([
                    'order_id' => $order->order_id,
                    'variant_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'price' => $item->price,
                ]);
            }

            $cart->items()->delete();
            DB::commit();

            return redirect()->route('client.checkout')->with('order_success', true);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Lỗi đặt hàng: ' . $e->getMessage(), [
                'line' => $e->getLine(),
                'file' => $e->getFile(),
            ]);
            return back()->with('error', 'Đã xảy ra lỗi khi xử lý đơn hàng.');
        }
    }

    public function momoPayment($amount)
    {
        $orderId = uniqid('momo_');
        $endpoint = env('MOMO_ENDPOINT', 'https://test-payment.momo.vn/v2/gateway/api/create');
        $partnerCode = env('MOMO_PARTNER_CODE');
        $accessKey = env('MOMO_ACCESS_KEY');
        $secretKey = env('MOMO_SECRET_KEY');
        $redirectUrl = route('payment.momo.callback');
        $ipnUrl = route('payment.momo.callback');
        $orderInfo = 'Thanh toán đơn hàng #' . $orderId;
        $requestId = uniqid();
        $extraData = '';

        $rawHash = "accessKey=$accessKey&amount=$amount&extraData=$extraData&ipnUrl=$ipnUrl&orderId=$orderId&orderInfo=$orderInfo&partnerCode=$partnerCode&redirectUrl=$redirectUrl&requestId=$requestId&requestType=captureWallet";
        $signature = hash_hmac('sha256', $rawHash, $secretKey);

        $data = [
            'partnerCode' => $partnerCode,
            'accessKey' => $accessKey,
            'requestId' => $requestId,
            'amount' => $amount,
            'orderId' => $orderId,
            'orderInfo' => $orderInfo,
            'redirectUrl' => $redirectUrl,
            'ipnUrl' => $ipnUrl,
            'extraData' => $extraData,
            'requestType' => 'captureWallet',
            'signature' => $signature,
            'lang' => 'vi',
        ];

        $ch = curl_init($endpoint);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        $result = curl_exec($ch);
        curl_close($ch);

        $jsonResult = json_decode($result, true);

        if (isset($jsonResult['payUrl'])) {
            session(['momo_order_id' => $orderId]);
            return redirect($jsonResult['payUrl']);
        } else {
            return back()->with('error', 'Không thể kết nối đến cổng thanh toán MoMo!');
        }
    }

    public function momoCallback(Request $request)
    {
        $resultCode = $request->input('resultCode');
        $orderId = session('momo_order_id');

        if ($resultCode == 0 && session()->has('checkout_info')) {
            $info = session('checkout_info');

            DB::beginTransaction();
            try {
                $order = Order::create([
                    'user_id' => $info['user_id'],
                    'status' => 'paid',
                    'payment_method' => 'momo',
                    'total_amount' => $info['total'],
                ]);

                foreach ($info['cart_items'] as $item) {
                    OrderItem::create([
                        'order_id' => $order->order_id,
                        'variant_id' => $item['product_id'],
                        'quantity' => $item['quantity'],
                        'price' => $item['price'],
                    ]);
                }

                // Xoá giỏ hàng
                $cart = Cart::getOrCreateCart($info['user_id'], session()->getId());
                $cart->items()->delete();

                DB::commit();
                session()->forget(['checkout_info', 'momo_order_id']);

                return redirect()->route('client.orders.index')->with('success', 'Thanh toán thành công qua Momo!');
            } catch (\Exception $e) {
                DB::rollBack();
                Log::error('Momo Callback Error: ' . $e->getMessage());
                return redirect()->route('client.orders.index')->with('error', 'Có lỗi xảy ra sau khi thanh toán Momo.');
            }
        }

        return redirect()->route('client.orders.index')->with('error', 'Thanh toán thất bại qua Momo.');
    }
}
