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
        Schema::create('list_exercises', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->json('title')->nullable();
            $table->unsignedBigInteger('chapter_id'); //order etmekde gerek bolya
            $table->unsignedBigInteger('lesson_id');
            $table->integer('order')->default(0);
            $table->timestamps();

            $table->foreign('chapter_id')->references('id')->on('chapters')->onDelete('cascade');
            $table->foreign('lesson_id')->references('id')->on('lessons')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('list_exercises');
    }
};
