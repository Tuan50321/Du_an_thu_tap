<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CommentSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('comments')->insert([
            [
                'user_id' => 1,
                'target_type' => 'product',
                'target_id' => 1,
                'content' => 'Sản phẩm rất tốt, giao hàng nhanh.',
                'is_hidden' => false,
                'created_at' => Carbon::now(),
            ],
            [
                'user_id' => 2,
                'target_type' => 'product',
                'target_id' => 2,
                'content' => 'Máy chạy êm, tiết kiệm điện, đáng mua.',
                'is_hidden' => false,
                'created_at' => Carbon::now()->subDays(1),
            ],
            [
                'user_id' => null,
                'target_type' => 'product',
                'target_id' => 1,
                'content' => 'Không hài lòng lắm, máy hơi ồn.',
                'is_hidden' => false,
                'created_at' => Carbon::now()->subDays(2),
            ],
        ]);
    }
}
