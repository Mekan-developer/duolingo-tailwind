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
        Schema::create('exercises', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->unsignedBigInteger('order');
            $table->string('description');
            $table->unsignedBigInteger('type_id');
            $table->timestamps();
        });

        Artisan::call('db:seed', ['--class' => 'ExerciseSeeder']);
        Artisan::call('db:seed', ['--class' => 'ExerciseCopyFilesSeeder']);

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exercises');
    }
};
