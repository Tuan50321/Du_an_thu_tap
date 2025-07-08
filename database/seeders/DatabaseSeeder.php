<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            // Người dùng & phân quyền
            UserSeeder::class,
            PermissionSeeder::class,
            UserRoleSeeder::class,
            UserProfileSeeder::class,

            // Danh mục, thương hiệu, sản phẩm
            CategorySeeder::class,
            BrandSeeder::class,
            ProductSeeder::class,
            ProductVariantSeeder::class,

            // Banners / Giảm giá / Mã giảm
            BannerSeeder::class,
            DiscountSeeder::class,
            CouponSeeder::class,

            // Đơn hàng & giỏ hàng
            OrderSeeder::class,
            OrderItemSeeder::class,
            CartItemSeeder::class,

            // Tin tức & bình luận
            NewsCategorySeeder::class,
            NewsSeeder::class,
            NewsCommentSeeder::class,

            // Đánh giá & bình luận chung
            ReviewSeeder::class,
            CommentSeeder::class,

            // Liên hệ & thông báo
            ContactSeeder::class,
            NotificationSeeder::class,
        ]);
    }
}
