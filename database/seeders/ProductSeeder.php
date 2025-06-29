<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
<<<<<<< HEAD
use Illuminate\Support\Facades\DB;
=======
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
>>>>>>> f2b6f01 (Merge branch 'main' of https://github.com/Tuan50321/Du_an_thu_tap)

class ProductSeeder extends Seeder
{
    public function run(): void
    {
<<<<<<< HEAD
        DB::table('products')->insert([
            [
                'category_id'    => 1,
                'brand_id'       => 1,
                'name'           => 'Nồi cơm điện Sharp KS-COM18V',
                'price'          => 1250000,
                'discount_price' => 1099000,
                'description'    => 'Nồi cơm điện dung tích 1.8L, công suất 700W, thiết kế hiện đại, phù hợp gia đình 4-6 người.',
                'thumbnail'      => 'images/products/noicom_sharp.jpg',
                'gallery'        => json_encode([
                    'images/products/noicom_sharp_1.jpg',
                    'images/products/noicom_sharp_2.jpg',
                ]),
                'status'         => 'active',
                'created_by'     => 1,
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            [
                'category_id'    => 2,
                'brand_id'       => 2,
                'name'           => 'Máy xay sinh tố Philips HR2223',
                'price'          => 1599000,
                'discount_price' => 1399000,
                'description'    => 'Công suất 700W, lưỡi xay ProBlend Crush, có cối phụ và cối xay thịt.',
                'thumbnail'      => 'images/products/mayxay_philips.jpg',
                'gallery'        => json_encode([
                    'images/products/mayxay_philips_1.jpg',
                    'images/products/mayxay_philips_2.jpg',
                ]),
                'status'         => 'active',
                'created_by'     => 1,
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            [
                'category_id'    => 3,
                'brand_id'       => 3,
                'name'           => 'Máy lọc không khí Xiaomi 4 Lite',
                'price'          => 3190000,
                'discount_price' => 2790000,
                'description'    => 'Lọc bụi mịn PM2.5, kết nối WiFi, điều khiển qua app Mi Home.',
                'thumbnail'      => 'images/products/mayloc_xiaomi.jpg',
                'gallery'        => json_encode([
                    'images/products/mayloc_xiaomi_1.jpg',
                    'images/products/mayloc_xiaomi_2.jpg',
                ]),
                'status'         => 'active',
                'created_by'     => 1,
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
        ]);
=======
        $categories = Category::all();
        $brands = Brand::all();
        $users = User::all();

        if ($categories->isEmpty() || $brands->isEmpty() || $users->isEmpty()) {
            $this->command->warn('⚠️ Thiếu dữ liệu liên kết: categories, brands hoặc users. Vui lòng seed trước.');
            return;
        }

        // Tạo thư mục chứa ảnh demo nếu chưa có
        Storage::disk('public')->makeDirectory('products');

        foreach (range(1, 20) as $i) {
            $price = rand(100000, 1000000);
            $discount_price = rand(0, 1) ? rand(50000, $price - 10000) : null;

            Product::create([
                'category_id' => $categories->random()->category_id,
                'brand_id' => $brands->random()->brand_id,
                'name' => 'Sản phẩm demo ' . $i,
                'price' => $price,
                'discount_price' => $discount_price,
                'description' => 'Mô tả cho sản phẩm demo số ' . $i,
                'status' => collect(['active', 'inactive'])->random(),
                'created_by' => $users->random()->id,
                'img' => 'products/default.jpg', // Bạn có thể thêm ảnh mặc định sẵn vào storage/app/public/products/default.jpg
            ]);
        }

        $this->command->info('✅ Đã tạo 20 sản phẩm demo.');
>>>>>>> f2b6f01 (Merge branch 'main' of https://github.com/Tuan50321/Du_an_thu_tap)
    }
}
