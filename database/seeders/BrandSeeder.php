<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
<<<<<<< HEAD
use Illuminate\Support\Str;
use App\Models\Brand; // Quan trọng: cần model Brand
=======
use App\Models\Brand;
use Illuminate\Support\Str;
>>>>>>> f2b6f01 (Merge branch 'main' of https://github.com/Tuan50321/Du_an_thu_tap)

class BrandSeeder extends Seeder
{
    public function run(): void
    {
        $brands = [
<<<<<<< HEAD
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
=======
            'Apple' => 'Thương hiệu công nghệ nổi tiếng toàn cầu với các sản phẩm iPhone, Macbook, AirPods...',
            'Samsung' => 'Thương hiệu hàng đầu Hàn Quốc trong lĩnh vực điện tử và điện thoại.',
            'Nike' => 'Thương hiệu thời trang thể thao nổi tiếng với giày và trang phục chất lượng.',
            'Adidas' => 'Thương hiệu thể thao toàn cầu nổi tiếng với thiết kế trẻ trung.',
            'Panasonic' => 'Thương hiệu Nhật Bản chuyên về đồ điện tử và gia dụng.',
            'Sony' => 'Cung cấp các sản phẩm công nghệ cao cấp như TV, máy ảnh, tai nghe.',
            'LG' => 'Tập đoàn điện tử lớn của Hàn Quốc, nổi bật với TV, tủ lạnh, máy giặt.',
        ];

        foreach ($brands as $name => $desc) {
            Brand::create([
                'name' => $name,
                'slug' => Str::slug($name),
                'description' => $desc
            ]);
        }

        $this->command->info('✅ Đã seed dữ liệu brands.');
>>>>>>> f2b6f01 (Merge branch 'main' of https://github.com/Tuan50321/Du_an_thu_tap)
    }
}
