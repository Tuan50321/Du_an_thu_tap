<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Banner;

class BannerSeeder extends Seeder
{
    public function run(): void
    {
        $banners = [
            [
                'image_url' => 'banners/banner1.jpg',
                'link_url' => 'https://example.com/summer-sale',
                'position' => 'top',
                'is_active' => true,
            ],
            [
                'image_url' => 'banners/banner2.jpg',
                'link_url' => 'https://example.com/winter-sale',
                'position' => 'bottom',
                'is_active' => true,
            ],
            [
                'image_url' => 'banners/banner3.jpg',
                'link_url' => null,
                'position' => 'sidebar',
                'is_active' => false,
            ],
        ];

        foreach ($banners as $banner) {
            Banner::create($banner);
        }

        $this->command->info('✅ Đã seed dữ liệu banner.');
    }
}

