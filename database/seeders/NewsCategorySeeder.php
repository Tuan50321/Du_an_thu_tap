<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
<<<<<<< HEAD
use Illuminate\Support\Str;
use App\Models\NewsCategory;
=======
use Illuminate\Support\Facades\DB;
>>>>>>> f2b6f01 (Merge branch 'main' of https://github.com/Tuan50321/Du_an_thu_tap)

class NewsCategorySeeder extends Seeder
{
    public function run(): void
    {
<<<<<<< HEAD
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
=======
        DB::table('news_categories')->insert([
            ['name' => 'Tin tức công nghệ', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Sự kiện', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Khuyến mãi', 'created_at' => now(), 'updated_at' => now()],
        ]);
>>>>>>> f2b6f01 (Merge branch 'main' of https://github.com/Tuan50321/Du_an_thu_tap)
    }
}
