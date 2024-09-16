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
        $typeId = DB::table('exercise_types')->where('code', 'QUESTION_WORD')->value('id');

        Schema::create('question_words', function (Blueprint $table) use ($typeId) {
            $table->id();
            $table->string('en_text');
            $table->string('audio');
            $table->json('translation_correct_words');
            $table->json('translation_incorrect_words');
            $table->unsignedBigInteger('chapter_id');
            $table->unsignedBigInteger('lesson_id');
            $table->unsignedBigInteger('exercise_id');
            $table->unsignedBigInteger('type_id')->default($typeId);
            $table->integer('order');
            $table->boolean('status')->default(true);
            $table->timestamps();

            $table->foreign('chapter_id')->references('id')->on('chapters')->onDelete('cascade');
            $table->foreign('lesson_id')->references('id')->on('lessons')->onDelete('cascade');
            $table->foreign('exercise_id')->references('id')->on('list_exercises')->onDelete('cascade');
            $table->foreign('type_id')->references('id')->on('exercise_types');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('question_words');
    }
};
