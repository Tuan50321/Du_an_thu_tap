<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('user_profiles', function (Blueprint $table) {
            $table->id(); // Sử dụng id thay vì profile_id
            $table->unsignedBigInteger('user_id')->nullable()->index();
            $table->string('phone', 20)->nullable();
            $table->string('province', 100)->nullable();
            $table->string('district', 100)->nullable();
            $table->string('ward', 100)->nullable();
            $table->string('street', 255)->nullable();
            $table->date('birthday')->nullable();
            $table->string('gender', 10)->nullable();
            $table->timestamps();

            // Khóa ngoại nếu có bảng users
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_profiles');
    }
};
