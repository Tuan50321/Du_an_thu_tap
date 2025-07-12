<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('product_variants', function (Blueprint $table) {
            $table->bigIncrements('variant_id');
            $table->unsignedBigInteger('product_id')->nullable();
$table->foreign('product_id')->references('product_id')->on('products')->nullOnDelete();

            $table->string('color', 50)->nullable();
            $table->string('material', 50)->nullable();
            $table->integer('stock')->nullable();
            $table->decimal('price', 10, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_variants');
    }
};
