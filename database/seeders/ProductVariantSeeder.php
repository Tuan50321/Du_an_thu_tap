<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductVariantSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('product_variants')->insert([
            [
                'product_id' => 1,
                'color'      => 'Trắng',
                'material'   => 'Nhựa ABS',
                'stock'      => 50,
                'price'      => 1099000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 1,
                'color'      => 'Đỏ đô',
                'material'   => 'Nhựa ABS',
                'stock'      => 30,
                'price'      => 1150000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 2,
                'color'      => 'Bạc',
                'material'   => 'Thủy tinh & nhựa',
                'stock'      => 20,
                'price'      => 1399000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 3,
                'color'      => 'Trắng',
                'material'   => 'Nhựa cao cấp',
                'stock'      => 15,
                'price'      => 2790000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
