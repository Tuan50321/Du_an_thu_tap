<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BannerSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('banners')->insert([
            [
                'title' => 'Summer Sale',
                'description' => 'Giảm giá lên đến 50% cho tất cả sản phẩm hè!',
                'image' => 'banners/banner1.jpg',
                'link' => 'https://example.com/summer-sale',
                'sort_order' => 1,
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Back to School',
                'description' => 'Ưu đãi đặc biệt cho mùa tựu trường!',
                'image' => 'banners/banner2.jpg',
                'link' => 'https://example.com/back-to-school',
                'sort_order' => 2,
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Flash Sale',
                'description' => 'Chỉ hôm nay! Săn deal cực sốc.',
                'image' => 'banners/banner3.jpg',
                'link' => 'https://example.com/flash-sale',
                'sort_order' => 3,
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        $this->command->info('✅ Đã seed dữ liệu banner.');
    }
}
