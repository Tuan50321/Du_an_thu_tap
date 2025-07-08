<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Brand; // Quan trọng: cần model Brand

class BrandSeeder extends Seeder
{
    public function run(): void
    {
        $brands = [
            [
                'name' => 'Panasonic',
                'description' => 'Thương hiệu Nhật Bản nổi tiếng với các sản phẩm điện gia dụng như tủ lạnh, máy giặt, lò vi sóng.',
            ],
            [
                'name' => 'Sharp',
                'description' => 'Chuyên cung cấp đồ gia dụng bền bỉ và tiết kiệm điện năng.',
            ],
            [
                'name' => 'Electrolux',
                'description' => 'Thương hiệu Thụy Điển với thiết kế hiện đại, chất lượng cao.',
            ],
            [
                'name' => 'Sunhouse',
                'description' => 'Thương hiệu Việt nổi tiếng với nồi cơm điện, bếp từ, máy lọc nước,...',
            ],
            [
                'name' => 'LG',
                'description' => 'Tập đoàn công nghệ Hàn Quốc cung cấp máy giặt, tủ lạnh, điều hòa,...',
            ],
            [
                'name' => 'Philips',
                'description' => 'Nổi tiếng với các sản phẩm chăm sóc sức khỏe và đồ gia dụng nhỏ.',
            ],
        ];

        foreach ($brands as $brand) {
            Brand::firstOrCreate(
                ['name' => $brand['name']], // Điều kiện kiểm tra trùng
                [
                    'slug' => Str::slug($brand['name']),
                    'description' => $brand['description'],
                ]
            );
        }
    }
}
