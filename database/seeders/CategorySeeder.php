<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $parentCategories = [
            'Thời trang',
            'Điện tử',
            'Sách',
            'Mỹ phẩm',
            'Đồ gia dụng'
        ];

        foreach ($parentCategories as $name) {
            $parent = Category::create([
                'name' => $name,
                'slug' => Str::slug($name),
                'parent_id' => null
            ]);

            // Tạo danh mục con cho mỗi danh mục cha
            foreach (range(1, 2) as $i) {
                $childName = $name . ' phụ ' . $i;
                Category::create([
                    'name' => $childName,
                    'slug' => Str::slug($childName),
                    'parent_id' => $parent->category_id
                ]);
            }
        }

        $this->command->info('✅ Đã seed dữ liệu danh mục và danh mục con.');
    }
}
