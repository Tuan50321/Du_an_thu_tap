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
        Schema::create('banners', function (Blueprint $table) {
            $table->id('banner_id');
            $table->string('image_url')->nullable();
            $table->string('link_url')->nullable();

            // Sửa kiểu position từ integer -> string (hoặc enum nếu muốn giới hạn)
            $table->string('position', 50)->nullable();

            $table->boolean('is_active')->default(1);
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
