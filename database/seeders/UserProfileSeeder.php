<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserProfileSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('user_profiles')->insert([
            [
                'user_id'    => 1,
                'phone'      => '0901234567',
                'province'   => 'Hà Nội',
                'district'   => 'Ba Đình',
                'ward'       => 'Phúc Xá',
                'street'     => '123 Đường Láng',
                'birthday'   => '1990-01-01',
                'gender'     => 'Nam',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id'    => 2,
                'phone'      => '0912345678',
                'province'   => 'TP. Hồ Chí Minh',
                'district'   => 'Quận 1',
                'ward'       => 'Bến Nghé',
                'street'     => '456 Nguyễn Huệ',
                'birthday'   => '1992-02-02',
                'gender'     => 'Nữ',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id'    => 3,
                'phone'      => '0987654321',
                'province'   => 'Đà Nẵng',
                'district'   => 'Hải Châu',
                'ward'       => 'Thạch Thang',
                'street'     => '789 Trần Phú',
                'birthday'   => '1995-03-03',
                'gender'     => 'Nam',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
