<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartsTable extends Migration
{
    public function up()
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->id(); // bigint UNSIGNED AUTO_INCREMENT
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('session_id')->nullable();
            $table->string('status', 50)->default('pending');
            $table->timestamps();

            $table->unique(['user_id', 'session_id'], 'user_id_session_id_unique');
        });
    }

    public function down()
    {
        Schema::dropIfExists('carts');
    }
}
