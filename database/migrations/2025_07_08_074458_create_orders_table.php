<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('order_id');

            // Khai báo user_id đúng kiểu
            $table->unsignedBigInteger('user_id');

            // Khóa ngoại CHUẨN – không dùng constrained()
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');

            $table->string('status', 30)->nullable();
            $table->string('payment_method', 20)->nullable();
            $table->decimal('total_amount', 10, 2)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
