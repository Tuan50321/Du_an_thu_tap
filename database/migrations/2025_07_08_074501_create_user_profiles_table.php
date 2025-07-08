<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('user_profiles', function (Blueprint $table) {
            $table->bigIncrements('profile_id');
            $table->unsignedBigInteger('user_id')->nullable()->index();
            $table->string('phone', 20)->nullable();
            $table->string('province', 100)->nullable();
            $table->string('district', 100)->nullable();
            $table->string('ward', 100)->nullable();
            $table->string('street', 255)->nullable();
            $table->date('birthday')->nullable();
            $table->string('gender', 10)->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();

            // Khóa ngoại nếu có bảng users
            // $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_profiles');
    }
};
