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
        
            // ✅ Tạo cột user_id trước khi tạo foreign key
            $table->foreignId('user_id')
                ->nullable() // phải có dòng này
                ->constrained('users')
                ->nullOnDelete();
        
            $table->unsignedBigInteger('news_id')->nullable();
            $table->foreign('news_id')
                ->references('news_id')
                ->on('news')
                ->onDelete('cascade');
        
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
