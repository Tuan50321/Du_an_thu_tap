<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Log;

class CheckoutController extends Controller
{
    /**
     * Hiển thị trang thanh toán
     */
    public function show()
    {
        $user = Auth::user();
        $cart = Cart::getOrCreateCart($user->id, session()->getId());
        $cartItems = $cart->items()->with('product')->get();

        $total = $cartItems->sum(function ($item) {
            return $item->quantity * $item->price;
        });

        return view('client.orders.checkout', compact('cartItems', 'total', 'user'));
    }

    /**
     * Lưu đơn hàng sau khi người dùng xác nhận thanh toán
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'phone' => 'required',
            'address' => 'required|string',
            'payment_method' => 'required|in:cod,bank_transfer,vnpay', // <- thêm vnpay vào đây
        ]);

        $user = Auth::user();
        $cart = Cart::getOrCreateCart($user->id, session()->getId());
        $cartItems = $cart->items()->with('product')->get();

        if ($cartItems->count() === 0) {
            return redirect()->back()->with('error', 'Giỏ hàng của bạn đang trống!');
        }

        DB::beginTransaction();
        try {
            // Tạo đơn hàng
            $order = Order::create([
                'user_id' => $user->id,
                'status' => 'pending',
                'payment_method' => $request->payment_method,
                'total_amount' => $cartItems->sum(fn($i) => $i->price * $i->quantity),
            ]);

            // Tạo các mục trong đơn hàng
            foreach ($cartItems as $item) {
                OrderItem::create([
                    'order_id' => $order->order_id,
                    'variant_id' => $item->product_id, // dùng product_id làm variant_id nếu không có bảng variant riêng
                    'quantity' => $item->quantity,
                    'price' => $item->price,
                ]);
            }

            // Xoá toàn bộ mục trong giỏ
            $cart->items()->delete();

            DB::commit();

        return redirect()->route('client.checkout')->with('order_success', true);
        } catch (\Exception $e) {
    DB::rollBack();

    Log::error('Lỗi đặt hàng: ' . $e->getMessage(), [
        'line' => $e->getLine(),
        'file' => $e->getFile(),
        'trace' => $e->getTraceAsString(),
    ]);

    return back()->with('error', 'Đã xảy ra lỗi khi xử lý đơn hàng. Vui lòng thử lại!');
}
    }
}
