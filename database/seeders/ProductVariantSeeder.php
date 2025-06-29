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
<<<<<<< HEAD
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
=======
                'ram'        => '4GB',
                'rom'        => '64GB',
                'color'      => 'Đen',
                'material'   => 'Nhựa',
                'stock'      => 20,
                'price'      => 150000,
            ],
            [
                'product_id' => 2,
                'ram'        => '6GB',
                'rom'        => '128GB',
                'color'      => 'Trắng',
                'material'   => 'Kính',
                'stock'      => 15,
                'price'      => 200000,
            ],
        ]);

        $this->command->info('✅ Đã thêm product_variants.');
>>>>>>> f2b6f01 (Merge branch 'main' of https://github.com/Tuan50321/Du_an_thu_tap)
    }
}
