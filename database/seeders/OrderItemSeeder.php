<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderItemSeeder extends Seeder
{
    public function run(): void
    {
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
    }
}
