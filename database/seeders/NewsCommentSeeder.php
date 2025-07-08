<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NewsCommentSeeder extends Seeder
{
    public function run(): void
    {
        // Giả định có sẵn user_id = 1,2 và news_id = 1,2
        $comments = [
            [
                'user_id' => 1,
                'news_id' => 1,
                'content' => 'Bài viết rất hữu ích, cảm ơn shop!',
                'is_hidden' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 2,
                'news_id' => 1,
                'content' => 'Thông tin chi tiết và rõ ràng.',
                'is_hidden' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 1,
                'news_id' => 2,
                'content' => 'Mong shop chia sẻ thêm nhiều mẹo vặt khác!',
                'is_hidden' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('news_comments')->insert($comments);
    }
}
