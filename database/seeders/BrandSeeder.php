<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Brand;
use Illuminate\Support\Str;

class BrandSeeder extends Seeder
{
    public function run(): void
    {
        $brands = [
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
    }
}

