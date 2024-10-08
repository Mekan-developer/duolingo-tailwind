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
        Schema::create('languages', function (Blueprint $table) {
            $table->id();
            $table->string('locale')->unique(); //ru
            $table->string('name')->unique(); //Russian
            $table->string('native')->unique(); //Русский
            $table->string('flag')->unique(); //flag name 
            $table->boolean('status')->default(1);
            $table->integer('order');
            $table->timestamps();
        });

        Artisan::call('db:seed', ['--class' => 'LanguageSeeder',]);
        Artisan::call('db:seed', ['--class' => 'CopyFilesSeeder',]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('languages');
    }
};
