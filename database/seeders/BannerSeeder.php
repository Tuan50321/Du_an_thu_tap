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
    }
}
