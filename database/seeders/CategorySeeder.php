<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
<<<<<<< HEAD
use Illuminate\Support\Facades\DB;
=======
use App\Models\Category;
use Illuminate\Support\Str;
>>>>>>> f2b6f01 (Merge branch 'main' of https://github.com/Tuan50321/Du_an_thu_tap)

class CategorySeeder extends Seeder
{
    public function run(): void
    {
<<<<<<< HEAD
        DB::table('categories')->insert([
            ['name' => 'Nồi cơm điện', 'slug' => 'noi-com-dien', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Bếp điện từ', 'slug' => 'bep-dien-tu', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Máy hút bụi', 'slug' => 'may-hut-bui', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Quạt điều hòa', 'slug' => 'quat-dieu-hoa', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Máy giặt', 'slug' => 'may-giat', 'created_at' => now(), 'updated_at' => now()],
        ]);
=======
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
>>>>>>> f2b6f01 (Merge branch 'main' of https://github.com/Tuan50321/Du_an_thu_tap)
    }
}
