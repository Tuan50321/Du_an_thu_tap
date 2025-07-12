<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('cart_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cart_id');
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->integer('quantity')->default(1);
            $table->decimal('price', 10, 2);
            $table->timestamp('added_at')->nullable();
            $table->timestamps();

            $table->foreign('cart_id')->references('id')->on('carts')->onDelete('cascade');
            $table->foreign('product_id')->references('product_id')->on('products')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users');
            $table->unique(['cart_id', 'product_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('cart_items');
    }
}; 