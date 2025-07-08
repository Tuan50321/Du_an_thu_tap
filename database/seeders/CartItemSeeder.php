<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class CartItemSeeder extends Seeder
{
    public function run(): void
    {
        // Lấy ngẫu nhiên 5 user_id và 5 variant_id
        $userIds = DB::table('users')->pluck('user_id')->take(5);
        $variantIds = DB::table('product_variants')->pluck('variant_id')->take(5);

        foreach ($userIds as $userId) {
            DB::table('cart_items')->insert([
                'user_id' => $userId,
                'variant_id' => $variantIds->random(),
                'quantity' => rand(1, 5),
                'added_at' => Carbon::now()->subDays(rand(0, 5)),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
