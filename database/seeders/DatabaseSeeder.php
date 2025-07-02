<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call([
            CouponSeeder::class,
            OrderSeeder::class,
            ProductSeeder::class,
            CategorySeeder::class,
            BrandSeeder::class,
            BannerSeeder::class,
            OrderItemSeeder::class,
            NewsSeeder::class,
            NewsCategorySeeder::class,
            NewsCommentSeeder::class,
            ContactSeeder::class,
            UserSeeder::class, // Ensure UserSeeder is called to seed users
        ]);
    }
}
