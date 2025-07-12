<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('news_comments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('news_id');
            $table->text('content');
            $table->boolean('is_hidden')->default(false);
            $table->timestamps();

            // Foreign Keys
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
            $table->foreign('news_id')->references('news_id')->on('news')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('news_comments');
    }
};
