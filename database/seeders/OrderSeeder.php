<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('orders')->insert([
            [
                'user_id' => 1, // Giả sử user_id 1 tồn tại
                'status' => 'pending',
                'payment_method' => 'cod',
                'total_amount' => 1248000.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 2,
                'status' => 'processing',
                'payment_method' => 'bank_transfer',
                'total_amount' => 785000.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 1,
                'status' => 'completed',
                'payment_method' => 'cod',
                'total_amount' => 299000.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
