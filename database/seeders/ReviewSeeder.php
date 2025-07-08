<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReviewSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('reviews')->insert([
            [
                'product_id' => 1,
                'user_id' => 1,
                'rating' => 5,
                'content' => 'Sản phẩm rất tốt, giao hàng nhanh, đóng gói cẩn thận.',
                'is_approved' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 2,
                'user_id' => 2,
                'rating' => 4,
                'content' => 'Ép nước khỏe, ít tiếng ồn. Giá hợp lý.',
                'is_approved' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 3,
                'user_id' => 3,
                'rating' => 3,
                'content' => 'Bếp dùng ổn, nhưng dây nguồn hơi ngắn.',
                'is_approved' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
