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
        Schema::create('comments', function (Blueprint $table) {
            $table->bigIncrements('comment_id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('target_type', 20)->nullable(); // Ví dụ: 'product', 'post', v.v.
            $table->unsignedBigInteger('target_id')->nullable();
            $table->text('content')->nullable();
            $table->boolean('is_hidden')->default(false);
            $table->timestamp('created_at')->nullable(); // Không dùng updated_at nên không cần timestamps()
            
            // Foreign key
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
