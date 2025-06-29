<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
<<<<<<< HEAD
use Illuminate\Support\Facades\DB;
=======
use App\Models\Banner;
>>>>>>> f2b6f01 (Merge branch 'main' of https://github.com/Tuan50321/Du_an_thu_tap)

class BannerSeeder extends Seeder
{
    public function run(): void
    {
<<<<<<< HEAD
        DB::table('banners')->insert([
            [
                'image_url' => 'https://example.com/images/banner1.jpg',
                'link_url' => '/collections/khuyen-mai',
                'position' => 'homepage_top',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'image_url' => 'https://example.com/images/banner2.jpg',
                'link_url' => '/collections/do-nha-bep',
                'position' => 'homepage_middle',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'image_url' => 'https://example.com/images/banner3.jpg',
                'link_url' => '/collections/tu-lanh',
                'position' => 'sidebar',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'image_url' => 'https://example.com/images/banner4.jpg',
                'link_url' => '/collections/may-loc-nuoc',
                'position' => 'footer',
                'is_active' => false, // chưa hiển thị
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
=======
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
>>>>>>> f2b6f01 (Merge branch 'main' of https://github.com/Tuan50321/Du_an_thu_tap)
    }
}
