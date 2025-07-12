<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\NewsCategory;

class NewsCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'Tin khuyến mãi',
            'Cẩm nang gia dụng',
            'Hướng dẫn sử dụng',
            'Tin tức công nghệ',
            'Mẹo vặt tiện ích',
        ];

        foreach ($categories as $name) {
            NewsCategory::firstOrCreate(
                ['slug' => Str::slug($name)], // điều kiện duy nhất
                ['name' => $name]
            );
        }
    }
}
