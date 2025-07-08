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
        Schema::create('categories', function (Blueprint $table) {
            $table->bigIncrements('category_id'); // Primary key
            $table->unsignedBigInteger('parent_id')->nullable(); // Self-referencing foreign key
            $table->string('name', 100)->nullable();
            $table->string('slug', 100)->nullable();
            $table->timestamps();

            // Foreign key
            $table->foreign('parent_id')->references('category_id')->on('categories')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
