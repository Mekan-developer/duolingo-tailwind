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
        $typeId = DB::table('exercise_types')->where('code', 'GRAMMAR_THEORY_PRACTICS')->value('id');
        $exerciseId = DB::table('exercises')->where('type_id', $typeId)->value('id');

        Schema::create('grammars', function (Blueprint $table) use ($typeId, $exerciseId) {
            $table->id();
            $table->json('grammar_theory');
            $table->json('text');
            $table->json('hint')->nullable();
            $table->json('text_correct_parts');
            $table->json('text_incorrect_parts');
            $table->string('audio');
            $table->unsignedBigInteger('chapter_id');
            $table->unsignedBigInteger('lesson_id');
            $table->unsignedBigInteger('exercise_id')->default($exerciseId);
            $table->unsignedBigInteger('type_id')->default($typeId);
            $table->integer('order');
            $table->boolean('status')->default(true);
            $table->timestamps();

            $table->foreign('chapter_id')->references('id')->on('chapters')->onDelete('cascade');
            $table->foreign('lesson_id')->references('id')->on('lessons')->onDelete('cascade');
            $table->foreign('exercise_id')->references('id')->on('exercises');
            $table->foreign('type_id')->references('id')->on('exercise_types');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grammars');
    }
};
