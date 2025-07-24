<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NewsSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('news')->insert([
            [
                'category_id' => 1,
                'title' => '5 mẹo dùng nồi chiên không dầu bền và tiết kiệm điện',
                'content' => 'Bạn đang sử dụng nồi chiên không dầu? Bài viết này chia sẻ 5 mẹo đơn giản giúp tăng tuổi thọ thiết bị và tiết kiệm điện năng khi nấu nướng.',
                'image' => 'uploads/news/air-fryer-tips.jpg',
                'author_id' => 1,
                'status' => 'published',
                'published_at' => now()->subDays(2),
                'created_at' => now()->subDays(3),
                'updated_at' => now()->subDays(1),
            ],
            [
                'category_id' => 2,
                'title' => 'Top 5 máy ép trái cây bán chạy nhất tại MOCO 2025',
                'content' => 'Khám phá 5 mẫu máy ép trái cây đang được khách hàng ưa chuộng nhất tại cửa hàng đồ gia dụng MOCO. Bền, đẹp và giá hợp lý!',
                'image' => 'uploads/news/top-juicers.jpg',
                'author_id' => 2,
                'status' => 'published',
                'published_at' => now()->subDays(5),
                'created_at' => now()->subDays(6),
                'updated_at' => now()->subDays(4),
            ],
            [
                'category_id' => 3,
                'title' => 'Cách bảo quản thực phẩm trong tủ lạnh đúng chuẩn gia đình Việt',
                'content' => 'Sắp xếp và bảo quản thực phẩm đúng cách không chỉ giúp giữ độ tươi ngon mà còn tiết kiệm điện và tránh lãng phí.',
                'image' => 'uploads/news/fridge-storage-tips.jpg',
                'author_id' => 1,
                'status' => 'draft',
                'published_at' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => 1,
                'title' => 'Chọn máy xay sinh tố: 3 tiêu chí bạn không nên bỏ qua',
                'content' => 'Bạn đang phân vân không biết nên mua máy xay loại nào? Hãy cùng MOCO tìm hiểu 3 yếu tố quan trọng khi chọn mua máy xay sinh tố.',
                'image' => 'uploads/news/blender-buying-guide.jpg',
                'author_id' => 2,
                'status' => 'published',
                'published_at' => now()->subDays(10),
                'created_at' => now()->subDays(11),
                'updated_at' => now()->subDays(9),
            ],
            [
                'category_id' => 2,
                'title' => '5 lỗi thường gặp khi sử dụng máy rửa bát tại nhà',
                'content' => 'Máy rửa bát là thiết bị tiện ích hiện đại. Tuy nhiên, người dùng thường gặp phải các lỗi như không làm sạch, nước không thoát... Tìm hiểu cách khắc phục ngay!',
                'image' => 'uploads/news/dishwasher-errors.jpg',
                'author_id' => 1,
                'status' => 'published',
                'published_at' => now()->subDays(15),
                'created_at' => now()->subDays(16),
                'updated_at' => now()->subDays(14),
            ],
            [
                'category_id' => 3,
                'title' => 'Cách làm sạch lò vi sóng đúng cách và nhanh chóng',
                'content' => 'Không cần hóa chất độc hại, chỉ với vài nguyên liệu tự nhiên bạn có thể làm sạch lò vi sóng trong vài phút. Cùng xem mẹo đơn giản của chúng tôi!',
                'image' => 'uploads/news/microwave-cleaning.jpg',
                'author_id' => 2,
                'status' => 'published',
                'published_at' => now()->subDays(20),
                'created_at' => now()->subDays(21),
                'updated_at' => now()->subDays(19), 
            ],
        ]);
    }
}
