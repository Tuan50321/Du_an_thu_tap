<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\NewsComment;
use App\Models\User;
use App\Models\News;
use Illuminate\Support\Facades\DB;

class NewsCommentSeeder extends Seeder
{
    public function run()
    {
        // XÓA TRƯỚC nếu có
        DB::table('news_comments')->truncate();

        // Tạo 2 user có user_id là 1 và 2 (phù hợp với foreign key)
        $user1 = User::firstOrCreate(['user_id' => 1], [
            'name' => 'Nguyễn Văn A',
            'email' => 'a@example.com',
            'password' => bcrypt('12345678'),
        ]);

        $user2 = User::firstOrCreate(['user_id' => 2], [
            'name' => 'Trần Thị B',
            'email' => 'b@example.com',
            'password' => bcrypt('12345678'),
        ]);

        // Tạo 2 bản ghi news
        $news1 = News::firstOrCreate(['news_id' => 1], [
            'title' => 'Tin tức công nghệ AI',
            'content' => 'Nội dung bài viết về AI...',
            'author_id' => $user1->user_id,
            'status' => 'published',
            'published_at' => now(),
        ]);

        $news2 = News::firstOrCreate(['news_id' => 2], [
            'title' => 'Xu hướng Laravel 2025',
            'content' => 'Nội dung bài viết về Laravel...',
            'author_id' => $user2->user_id,
            'status' => 'published',
            'published_at' => now(),
        ]);

        // Tạo 2 bình luận cụ thể
        NewsComment::create([
            'user_id' => $user1->user_id,
            'news_id' => $news1->news_id,
            'content' => 'Bài viết rất hay, cảm ơn tác giả!',
            'is_hidden' => false,
        ]);

        NewsComment::create([
            'user_id' => $user2->user_id,
            'news_id' => $news2->news_id,
            'content' => 'Thông tin rất hữu ích, mong có thêm bài mới!',
            'is_hidden' => false,
        ]);

        // Nếu bạn có factory, chạy thêm 3 cái:
        // NewsComment::factory()->count(3)->create();
    }
}
