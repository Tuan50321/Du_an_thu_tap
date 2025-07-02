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
<<<<<<<< HEAD:database/migrations/2025_06_27_194732_create_variants_table.php
        Schema::create('variants', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')->references('product_id')->on('products')->onDelete('cascade');
            $table->decimal('price', 10, 2);
========
        Schema::create('banners', function (Blueprint $table) {
            $table->id('banner_id');
            $table->string('image_url')->nullable();
            $table->string('link_url')->nullable();
            $table->integer('position')->nullable();
            $table->boolean('is_active')->default(1);
>>>>>>>> fceca83afe98503d4e3dd7d8c33e1021fdb4d089:database/migrations/2025_06_29_105343_create_banners_table.php
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('banners');
    }
};
