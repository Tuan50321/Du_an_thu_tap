<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
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
    }
}
