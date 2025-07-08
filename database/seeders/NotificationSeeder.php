<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NotificationSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('notifications')->insert([
            [
                'user_id' => 1, // Giả định user_id 1 tồn tại
                'content' => '🛒 Đơn hàng #1001 của bạn đã được xác nhận.',
                'is_read' => false,
                'created_at' => now()->subMinutes(30),
                'updated_at' => now()->subMinutes(30),
            ],
            [
                'user_id' => 2,
                'content' => '📝 Bình luận mới về sản phẩm "Máy lọc không khí Xiaomi".',
                'is_read' => false,
                'created_at' => now()->subHours(1),
                'updated_at' => now()->subHours(1),
            ],
            [
                'user_id' => 1,
                'content' => '🎉 Tin khuyến mãi: Giảm giá 20% cho đồ gia dụng đến hết tuần này!',
                'is_read' => true,
                'created_at' => now()->subDays(1),
                'updated_at' => now()->subDays(1),
            ],
        ]);
    }
}
