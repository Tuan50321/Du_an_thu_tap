<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
<<<<<<< HEAD

class NewsSeeder extends Seeder
{
=======
use Carbon\Carbon;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
>>>>>>> f2b6f01 (Merge branch 'main' of https://github.com/Tuan50321/Du_an_thu_tap)
    public function run(): void
    {
        DB::table('news')->insert([
            [
<<<<<<< HEAD
                'category_id' => 1, // giả định category_id 1 tồn tại
                'title' => 'Mẹo sử dụng nồi chiên không dầu đúng cách',
                'content' => 'Nồi chiên không dầu giúp tiết kiệm thời gian nấu nướng. Trong bài viết này, chúng tôi chia sẻ các mẹo để sử dụng hiệu quả nhất...',
                'image' => 'uploads/news/air-fryer-tips.jpg',
                'author_id' => 1, // giả định user_id 1 tồn tại
                'status' => 'published',
                'published_at' => now()->subDays(2),
                'created_at' => now()->subDays(3),
                'updated_at' => now()->subDays(1),
            ],
            [
                'category_id' => 2,
                'title' => 'Top 5 máy ép trái cây tốt nhất 2025',
                'content' => 'Bạn đang tìm kiếm máy ép trái cây tốt, bền và giá hợp lý? Dưới đây là 5 sản phẩm đáng mua nhất năm nay...',
                'image' => 'uploads/news/top-juicers.jpg',
                'author_id' => 2,
                'status' => 'published',
                'published_at' => now()->subDays(5),
                'created_at' => now()->subDays(6),
                'updated_at' => now()->subDays(4),
=======
                'title' => 'Giới thiệu sản phẩm mới',
                'content' => 'Chúng tôi hân hạnh giới thiệu sản phẩm mới nhất của năm 2025...',
                'author_id' => 1, // Giả sử user_id = 1 tồn tại
                'status' => 'published',
                'published_at' => Carbon::now(),
            ],
            [
                'title' => 'Khuyến mãi lớn dịp hè',
                'content' => 'Đừng bỏ lỡ cơ hội sở hữu sản phẩm với mức giá ưu đãi...',
                'author_id' => 1,
                'status' => 'draft',
                'published_at' => null,
            ],
            [
                'title' => 'Cập nhật chính sách bảo hành',
                'content' => 'Chính sách bảo hành mới sẽ mang lại nhiều quyền lợi hơn cho khách hàng...',
                'author_id' => 1,
                'status' => 'published',
                'published_at' => Carbon::now()->subDays(3),
>>>>>>> f2b6f01 (Merge branch 'main' of https://github.com/Tuan50321/Du_an_thu_tap)
            ],
        ]);
    }
}
