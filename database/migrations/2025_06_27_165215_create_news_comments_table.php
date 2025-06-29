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

            // Khóa ngoại đúng kiểu và tên cột (user_id) từ bảng users
            $table->bigInteger('user_id'); // mặc định là signed

            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');


            // news_id phải đúng kiểu với bảng news
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
