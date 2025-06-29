<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
<<<<<<< HEAD
use Carbon\Carbon;

class ContactSeeder extends Seeder
{
=======

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
>>>>>>> f2b6f01 (Merge branch 'main' of https://github.com/Tuan50321/Du_an_thu_tap)
    public function run(): void
    {
        DB::table('contacts')->insert([
            [
<<<<<<< HEAD
                'is_read' => false,
                'name' => 'Nguyễn Văn A',
                'email' => 'nguyenvana@example.com',
                'phone' => '0912345678',
                'subject' => 'Hỏi về máy xay sinh tố',
                'message' => 'Sản phẩm còn hàng không? Có giao nhanh trong ngày không?',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'is_read' => true,
                'name' => 'Trần Thị B',
                'email' => 'tranthib@example.com',
                'phone' => '0987654321',
                'subject' => 'Góp ý về chất lượng dịch vụ',
                'message' => 'Nhân viên tư vấn rất nhiệt tình, mình rất hài lòng.',
                'created_at' => Carbon::now()->subDays(2),
                'updated_at' => Carbon::now()->subDays(2),
            ],
            [
                'is_read' => false,
                'name' => 'Lê Văn C',
                'email' => 'levanc@example.com',
                'phone' => null,
                'subject' => 'Liên hệ hỗ trợ',
                'message' => 'Tôi muốn hủy đơn hàng #12345',
                'created_at' => Carbon::now()->subDay(),
                'updated_at' => Carbon::now()->subDay(),
=======
                'name' => 'Nguyễn Văn A',
                'email' => 'vana@example.com',
                'phone' => '0912345678',
                'subject' => 'Tư vấn sản phẩm',
                'message' => 'Xin chào, tôi cần tư vấn về sản phẩm rau sạch.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Lê Thị B',
                'email' => 'vana@example.com',
                'phone' => '0988123456',
                'subject' => 'Phản hồi dịch vụ',
                'message' => 'Dịch vụ rất tốt, tôi rất hài lòng.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Trần Văn C',
                'email' => 'ivan@example.com',
                'phone' => '0912345678',
                'subject' => 'Đặt hàng',
                'message' => 'Tôi muốn đặt hàng một số sản phẩm rau sạch.',
                'created_at' => now(),
                'updated_at' => now(),
>>>>>>> f2b6f01 (Merge branch 'main' of https://github.com/Tuan50321/Du_an_thu_tap)
            ],
        ]);
    }
}
