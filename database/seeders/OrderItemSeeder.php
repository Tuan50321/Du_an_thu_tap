<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\OrderItem;
use App\Models\Order;

class OrderItemSeeder extends Seeder
{
    public function run(): void
    {
        $orders = Order::all();

        if ($orders->isEmpty()) {
            $this->command->warn('⚠️ Không có đơn hàng nào để tạo order_items.');
            return;
        }

        foreach ($orders as $order) {
            foreach (range(1, rand(1, 3)) as $i) {
                OrderItem::create([
                    'order_id' => $order->order_id ?? $order->id,
                    'variant_id' => rand(1, 5), // Điều chỉnh theo dữ liệu thật
                    'quantity' => rand(1, 5),
                    'price' => rand(10000, 100000),
                ]);
            }
        }

        $this->command->info('✅ Đã tạo order_items cho các đơn hàng.');
    }
}
