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

            // Foreign key: users.user_id
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')
                ->references('user_id')
                ->on('users')
                ->nullOnDelete();

            // Foreign key: products.product_id
            $table->unsignedBigInteger('product_id')->nullable();

            $table->integer('rating')->nullable();
            $table->text('content')->nullable();
            $table->boolean('is_approved')->default(0);

            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->useCurrent();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
