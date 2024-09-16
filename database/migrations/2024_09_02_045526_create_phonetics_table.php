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
        $typeId = DB::table('exercise_types')->where('code', 'PHONETICS')->value('id');

        Schema::create('phonetics', function (Blueprint $table) use ($typeId) {
            $table->id();
            $table->string('phonetic_alphabet');
            $table->json('phonetic_text');
            $table->string('audio');
            $table->json('examples');
            $table->string('sound1')->nullable();            
            $table->string('sound2')->nullable();            
            $table->string('sound3')->nullable();            
            $table->string('sound4')->nullable();            
            $table->string('sound5')->nullable();            

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
        Schema::dropIfExists('phonetics');
    }
};
