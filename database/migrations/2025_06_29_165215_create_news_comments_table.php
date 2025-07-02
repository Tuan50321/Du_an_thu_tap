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

            // Khóa ngoại đúng đến users(id)
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');

            // Khóa ngoại đến news(id)
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
