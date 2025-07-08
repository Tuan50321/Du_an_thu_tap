<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ContactSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('contacts')->insert([
            [
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
            ],
        ]);
    }
}
