<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewsCommentsTable extends Migration
{
    public function up()
    {
        Schema::create('news_comments', function (Blueprint $table) {
            $table->id();

<<<<<<< HEAD:database/migrations/2025_06_29_165215_create_news_comments_table.php
            // Khóa ngoại đúng đến users(id)
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');

            // Khóa ngoại đến news(id)
=======
            // Khóa ngoại đúng kiểu và tên cột (id) từ bảng users
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            // news_id phải đúng kiểu với bảng news
>>>>>>> fceca83afe98503d4e3dd7d8c33e1021fdb4d089:database/migrations/2025_06_27_165215_create_news_comments_table.php
            $table->unsignedBigInteger('news_id');
            $table->foreign('news_id')->references('news_id')->on('news')->onDelete('cascade');


            $table->text('content');
            $table->boolean('is_hidden')->default(false);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('news_comments');
    }
}
