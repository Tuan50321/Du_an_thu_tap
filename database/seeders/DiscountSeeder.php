<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DiscountSeeder extends Seeder
{
    public function run(): void
    {
        // Xóa toàn bộ dữ liệu cũ và reset ID tự tăng (nếu có)
        DB::table('discounts')->truncate();

        DB::table('discounts')->insert([
            [
                'code' => 'GIAM5',
                'discount_type' => 'percentage',
                'value' => 5,
                'start_date' => Carbon::now()->subDays(3),
                'end_date' => Carbon::now()->addDays(10),
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => 'GIAM50000',
                'discount_type' => 'fixed',
                'value' => 50000,
                'start_date' => Carbon::now()->subDays(1),
                'end_date' => Carbon::now()->addDays(20),
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => 'HETHANG7',
                'discount_type' => 'percentage',
                'value' => 10,
                'start_date' => Carbon::now()->addDays(1),
                'end_date' => Carbon::now()->addDays(15),
                'status' => 'upcoming',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
