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
            'Sunhouse' => 'Thương hiệu Việt Nam nổi tiếng với các sản phẩm nồi cơm điện, bếp gas, chảo chống dính.',
            'Kangaroo' => 'Thương hiệu đồ gia dụng hàng đầu với máy lọc nước, quạt điều hòa, nồi chiên không dầu.',
            'Midea' => 'Thương hiệu Trung Quốc nổi bật với tủ lạnh, máy giặt, lò vi sóng, điều hòa.',
            'Sharp' => 'Thương hiệu Nhật Bản cung cấp các sản phẩm gia dụng chất lượng như nồi cơm, lò vi sóng.',
            'Panasonic' => 'Thương hiệu uy tín đến từ Nhật với nhiều sản phẩm gia dụng cao cấp.',
            'Electrolux' => 'Thương hiệu Thụy Điển nổi bật với máy giặt, máy sấy, lò nướng, máy hút bụi.',
            'Philips' => 'Thương hiệu Hà Lan nổi tiếng với đồ điện gia dụng như máy ép, nồi chiên không dầu.',
            'Toshiba' => 'Thương hiệu Nhật Bản với các thiết bị gia dụng bền bỉ và tiện ích.',
        ];

        foreach ($brands as $name => $desc) {
            Brand::create([
                'name' => $name,
                'slug' => Str::slug($name),
                'description' => $desc
            ]);
        }

        $this->command->info('✅ Đã seed dữ liệu thương hiệu đồ gia dụng.');
    }
}
