<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use Illuminate\Support\Facades\Request;

class OrderClientController extends Controller
{
    public function index()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $orders = Order::with('items.variant.product')
                    ->where('user_id', $user->id)
                    ->orderBy('created_at', 'desc')
                    ->get();

        return view('client.orders.index', compact('orders'));
    }

    public function cancel($orderId)
    {
        $userId = Auth::id();

        $order = Order::where('order_id', $orderId) // dùng order_id
                      ->where('user_id', $userId)
                      ->where('status', 'pending')
                      ->firstOrFail();

        $order->status = 'cancelled';
        $order->save();

        return redirect()->back()->with('success', 'Đơn hàng đã được huỷ thành công.');
    }

    public function show($orderId)
    {
        $userId = Auth::id();

        $order = Order::with('items.variant.product')
                    ->where('order_id', $orderId) // dùng order_id
                    ->where('user_id', $userId)
                    ->firstOrFail();

        return view('client.orders.show', compact('order'));
    }
    public function destroy(Order $order)
    {
        // Kiểm tra trạng thái
        if ($order->status !== 'cancelled') {
            return back()->with('error', 'Chỉ có thể xoá đơn hàng đã huỷ.');
        }

        $order->delete(); // Nếu dùng soft delete thì đảm bảo model có use SoftDeletes

        return back()->with('success', 'Đơn hàng đã được xoá thành công.');
    }
   
}
