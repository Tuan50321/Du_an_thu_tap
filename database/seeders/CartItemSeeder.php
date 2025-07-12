<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class CartItemSeeder extends Seeder
{
    public function run(): void
    {
        // Lấy danh sách tất cả giỏ hàng (cart_id và user_id)
        $carts = DB::table('carts')->select('id as cart_id', 'user_id')->get();
        $productIds = DB::table('products')->pluck('product_id');

        // Kiểm tra dữ liệu
        if ($carts->isEmpty() || $productIds->isEmpty()) {
            $this->command->info('Bảng carts hoặc products không có dữ liệu. Dừng seed cart_items.');
            return;
        }

        foreach ($carts as $cart) {
            DB::table('cart_items')->insert([
                'cart_id'    => $cart->cart_id,
                'user_id'    => $cart->user_id,
                'product_id' => $productIds->random(),
                'quantity'   => rand(1, 5),
                'added_at'   => Carbon::now()->subDays(rand(0, 5)),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
