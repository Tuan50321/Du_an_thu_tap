<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('product_id');

            // Foreign key: categories.category_id
            $table->unsignedBigInteger('category_id')->nullable();
            $table->foreign('category_id')
                ->references('category_id')
                ->on('categories')
                ->nullOnDelete();

            // Foreign key: brands.brand_id
            $table->unsignedBigInteger('brand_id')->nullable();
            $table->foreign('brand_id')
                ->references('brand_id')
                ->on('brands')
                ->nullOnDelete();

            // Product info
            $table->string('name')->nullable();
            $table->decimal('price', 10, 2)->nullable();
            $table->decimal('discount_price', 10, 2)->nullable();
            $table->text('description')->nullable();
            $table->string('thumbnail')->nullable();
            $table->string('status', 20)->nullable();
            //gallery
            $table->text('gallery')->nullable();

            // Foreign key: users.user_id (⚠ Thêm dòng unsigned trước foreign key)
            $table->unsignedBigInteger('created_by')->nullable();
            $table->foreign('created_by')
                ->references('id') // ✅ tham chiếu đúng cột 'id' của bảng users
                ->on('users')
                ->nullOnDelete();            

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(['category_id']);
            $table->dropForeign(['brand_id']);
            $table->dropForeign(['created_by']);
        });

        Schema::dropIfExists('products');
    }
};
