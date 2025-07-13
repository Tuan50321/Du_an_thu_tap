<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('news_categories', function (Blueprint $table) {
            $table->bigIncrements('category_id');
            $table->string('name', 255);
            $table->string('slug', 255)->nullable()->unique();
            $table->timestamps(); // created_at & updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('news_categories');
    }
};
