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
        Schema::create('lessons', function (Blueprint $table) {
            $table->id();
            $table->json('title');
            $table->string('dopamine_image_1');//left image
            $table->string('dopamine_image_2');//right image
            $table->string('dopamine_image_3');//left bottom
            $table->string('dopamine_image_4'); //full image or bottom right 
            $table->unsignedBigInteger('chapter_id');
            $table->integer('order')->default(0);
            $table->timestamps();

            $table->foreign('chapter_id')->references('id')->on('chapters')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lessons');
    }
};
