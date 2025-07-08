<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Review;

class ReviewSeeder extends Seeder
{
    public function run(): void
    {
        $reviews = [
            [
                'user_id' => 1,
                'product_id' => 1,
                'rating' => 5,
                'content' => 'Sản phẩm rất tuyệt vời, tôi rất hài lòng!',
                'is_approved' => 1,
            ],
            [
                'user_id' => 2,
                'product_id' => 1,
                'rating' => 4,
                'content' => 'Chất lượng khá ổn, giao hàng nhanh.',
                'is_approved' => 1,
            ],
            [
                'user_id' => 3,
                'product_id' => 2,
                'rating' => 3,
                'content' => 'Tạm ổn, nhưng đóng gói chưa kỹ.',
                'is_approved' => 1,
            ],
            [
                'user_id' => 4,
                'product_id' => 3,
                'rating' => 2,
                'content' => 'Không giống như mô tả, cần cải thiện.',
                'is_approved' => 0,
            ],
            [
                'user_id' => 1,
                'product_id' => 4,
                'rating' => 4,
                'content' => 'Giá hợp lý, tôi sẽ mua lại.',
                'is_approved' => 1,
            ],
            [
                'user_id' => 2,
                'product_id' => 2,
                'rating' => 5,
                'content' => 'Đúng như mong đợi, rất đáng tiền.',
                'is_approved' => 1,
            ],
            [
                'user_id' => 3,
                'product_id' => 3,
                'rating' => 3,
                'content' => 'Ổn định, nhưng cần thêm màu sắc lựa chọn.',
                'is_approved' => 1,
            ],
            [
                'user_id' => 4,
                'product_id' => 4,
                'rating' => 2,
                'content' => 'Giao hàng chậm, chất lượng bình thường.',
                'is_approved' => 0,
            ],
        ];

        foreach ($reviews as $review) {
            Review::create($review);
        }
    }
}
