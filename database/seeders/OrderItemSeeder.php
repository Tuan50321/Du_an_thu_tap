<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
<<<<<<< HEAD
use Illuminate\Support\Facades\DB;
=======
use App\Models\OrderItem;
use App\Models\Order;
>>>>>>> f2b6f01 (Merge branch 'main' of https://github.com/Tuan50321/Du_an_thu_tap)

class OrderItemSeeder extends Seeder
{
    public function run(): void
    {
<<<<<<< HEAD
        DB::table('order_items')->insert([
            [
                'order_id' => 1, // cần đảm bảo order_id 1 tồn tại
                'variant_id' => 1, // cần đảm bảo variant_id 1 tồn tại
                'quantity' => 2,
                'price' => 499000.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'order_id' => 1,
                'variant_id' => 2,
                'quantity' => 1,
                'price' => 299000.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'order_id' => 2,
                'variant_id' => 3,
                'quantity' => 3,
                'price' => 150000.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
=======
        $orders = Order::all();

        if ($orders->isEmpty()) {
            $this->command->warn('⚠️ Không có đơn hàng nào để tạo order_items.');
            return;
        }

        foreach ($orders as $order) {
            foreach (range(1, rand(1, 2)) as $i) {
                OrderItem::create([
                    'order_id' => $order->order_id ?? $order->id,
                    'variant_id' => rand(1, 2), // Điều chỉnh theo dữ liệu thật
                    'quantity' => rand(1, 5),
                    'price' => rand(10000, 100000),
                ]);
            }
        }

        $this->command->info('✅ Đã tạo order_items cho các đơn hàng.');
>>>>>>> f2b6f01 (Merge branch 'main' of https://github.com/Tuan50321/Du_an_thu_tap)
    }
}
