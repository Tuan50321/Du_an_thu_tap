<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Str;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
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
    }
}
