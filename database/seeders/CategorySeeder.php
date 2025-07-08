<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        DB::table('categories')->insert([
            ['name' => 'Nồi cơm điện', 'slug' => 'noi-com-dien', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Bếp điện từ', 'slug' => 'bep-dien-tu', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Máy hút bụi', 'slug' => 'may-hut-bui', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Quạt điều hòa', 'slug' => 'quat-dieu-hoa', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Máy giặt', 'slug' => 'may-giat', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
