<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name'       => 'Admin Đồ Gia Dụng',
                'email'      => 'admin@giadung.vn',
                'password'   => Hash::make('admin123'),
                'role'       => 'admin',
                'is_active'  => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name'       => 'Nhân Viên Bán Hàng',
                'email'      => 'staff@giadung.vn',
                'password'   => Hash::make('staff123'),
                'role'       => 'staff',
                'is_active'  => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name'       => 'Nguyễn Văn Khách',
                'email'      => 'customer1@gmail.com',
                'password'   => Hash::make('customer123'),
                'role'       => 'customer',
                'is_active'  => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
