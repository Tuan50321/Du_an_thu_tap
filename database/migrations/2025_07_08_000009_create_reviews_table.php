<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->bigIncrements('review_id');

            // Foreign key: users.id
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')
                ->references('id') // ✅ sửa lại từ user_id → id
                ->on('users')
                ->nullOnDelete();

            // Foreign key: products.product_id
            $table->unsignedBigInteger('product_id')->nullable();
            $table->foreign('product_id')
                ->references('product_id')
                ->on('products')
                ->nullOnDelete();

            $table->integer('rating')->nullable();
            $table->text('content')->nullable();
            $table->boolean('is_approved')->default(0);

            $table->timestamps(); // dùng timestamps() cho tiện
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
