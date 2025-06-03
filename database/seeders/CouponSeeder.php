<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Coupon;

class CouponSeeder extends Seeder
{
    public function run()
    {
        Coupon::insert([
            [
                'code' => 'WELCOME10',
                'discount_type' => 'percentage',
                'value' => 10,
                'max_discount_amount' => 50000,
                'min_order_value' => 100000,
                'max_order_value' => null,
                'max_usage_per_user' => 1,
                'start_date' => now()->subDays(5),
                'end_date' => now()->addDays(30),
                'status' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => 'FLAT50K',
                'discount_type' => 'fixed',
                'value' => 50000,
                'max_discount_amount' => 50000,
                'min_order_value' => 200000,
                'max_order_value' => 1000000,
                'max_usage_per_user' => 2,
                'start_date' => now()->subDays(1),
                'end_date' => now()->addDays(15),
                'status' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}

