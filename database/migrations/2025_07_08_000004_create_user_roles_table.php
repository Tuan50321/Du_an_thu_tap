<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('user_roles', function (Blueprint $table) {
            $table->bigIncrements('user_role_id');

            // Dùng foreignId thay cho tạo thủ công + foreign
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade');

            // Giữ nguyên permission_id nếu bảng permissions có khóa chính là 'permission_id'
            $table->unsignedBigInteger('permission_id')->nullable();
            $table->foreign('permission_id')->references('permission_id')->on('permissions')->onDelete('cascade');

            $table->timestamps();

            // Indexes
            $table->index('user_id');
            $table->index('permission_id');
        });
    }

    public function down(): void
    {
        Schema::table('user_roles', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['permission_id']);
        });

        Schema::dropIfExists('user_roles');
    }
};
