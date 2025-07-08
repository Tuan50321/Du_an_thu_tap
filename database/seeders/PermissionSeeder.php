<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('permissions')->insert([
            [
                'name' => 'manage_users',
                'description' => 'Quản lý người dùng (thêm, sửa, xóa)',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'manage_products',
                'description' => 'Quản lý sản phẩm (thêm, sửa, xóa)',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'view_orders',
                'description' => 'Xem và xử lý đơn hàng',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'manage_categories',
                'description' => 'Quản lý danh mục sản phẩm',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'manage_news',
                'description' => 'Quản lý bài viết tin tức',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
