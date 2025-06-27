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
    }
}
