<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
<<<<<<< HEAD
use Illuminate\Support\Facades\DB;
=======
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Str;
>>>>>>> f2b6f01 (Merge branch 'main' of https://github.com/Tuan50321/Du_an_thu_tap)

class OrderSeeder extends Seeder
{
    public function run(): void
    {
<<<<<<< HEAD
        DB::table('orders')->insert([
            [
                'user_id' => 1, // Giả sử user_id 1 tồn tại
                'status' => 'pending',
                'payment_method' => 'cod',
                'total_amount' => 1248000.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 2,
                'status' => 'processing',
                'payment_method' => 'bank_transfer',
                'total_amount' => 785000.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 1,
                'status' => 'completed',
                'payment_method' => 'cod',
                'total_amount' => 299000.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
=======
        $users = User::all();

        if ($users->isEmpty()) {
            $this->command->warn('⚠️ Không có user nào trong bảng users. Hãy chạy UserSeeder trước!');
            return;
        }

        foreach (range(1, 20) as $i) {
            Order::create([
                'user_id' => \App\Models\User::inRandomOrder()->first()?->id ?? 1,
                'status' => collect(['pending', 'completed', 'cancelled'])->random(),
                'payment_method' => collect(['cod', 'bank_transfer', 'momo'])->random(),
                'total_amount' => rand(50000, 500000),
                'created_at' => now()->subDays(rand(0, 30)),
            ]);
        }

        $this->command->info('✅ Đã tạo 20 đơn hàng mẫu.');
>>>>>>> f2b6f01 (Merge branch 'main' of https://github.com/Tuan50321/Du_an_thu_tap)
    }
}
