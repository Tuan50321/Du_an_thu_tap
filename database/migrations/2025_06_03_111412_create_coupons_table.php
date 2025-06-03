<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

public function up()
{
    Schema::create('coupons', function (Blueprint $table) {
        $table->id('coupon_id');
        $table->string('code')->unique();
        $table->enum('discount_type', ['percentage', 'fixed']);
        $table->decimal('value', 10, 2);
        $table->decimal('max_discount_amount', 10, 2)->nullable();
        $table->decimal('min_order_value', 10, 2)->nullable();
        $table->decimal('max_order_value', 10, 2)->nullable();
        $table->integer('max_usage_per_user')->default(1);
        $table->date('start_date');
        $table->date('end_date');
        $table->boolean('status')->default(true);
        $table->timestamps();
    });
}

    public function down(): void
    {
        Schema::dropIfExists('coupons');
    }
};
