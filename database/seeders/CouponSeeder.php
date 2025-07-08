<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CouponSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('coupons')->insert([
            [
                'code' => 'GIAM10',
                'discount_type' => 'percentage',
                'value' => 10,
                'max_discount_amount' => 50000,
                'min_order_value' => 300000,
                'max_order_value' => null,
                'max_usage_per_user' => 1,
                'start_date' => Carbon::now()->subDays(1),
                'end_date' => Carbon::now()->addDays(30),
                'status' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => 'FREESHIP50',
                'discount_type' => 'fixed',
                'value' => 50000,
                'max_discount_amount' => null,
                'min_order_value' => 500000,
                'max_order_value' => 2000000,
                'max_usage_per_user' => 2,
                'start_date' => Carbon::now()->subDays(5),
                'end_date' => Carbon::now()->addDays(10),
                'status' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => 'DOGIADUNG20',
                'discount_type' => 'percentage',
                'value' => 20,
                'max_discount_amount' => 100000,
                'min_order_value' => 1000000,
                'max_order_value' => null,
                'max_usage_per_user' => 1,
                'start_date' => Carbon::now(),
                'end_date' => Carbon::now()->addDays(15),
                'status' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
