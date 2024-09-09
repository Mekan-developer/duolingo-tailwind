<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChapterController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\ListExerciseController;

Route::get('/', function () { return view('dashboard');})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    
    Route::get('/chapters',[ChapterController::class,'index'])->name('chapters');
    Route::get('/chapters/create',[ChapterController::class,'create'])->name('chapter.create');
    Route::post('/chapters/store',[ChapterController::class,'store'])->name('chapter.store');
    Route::put('/chapters/edit/{chapter}',[ChapterController::class,'edit'])->name('chapter.edit');
    Route::patch('/chapters/update/{chapter}',[ChapterController::class,'update'])->name('chapter.update');
    Route::delete('/chapters/delete/{chapter}',[ChapterController::class,'destroy'])->name('chapter.delete');

    Route::get('/lessons',[LessonController::class,'index'])->name('lessons');
    Route::get('/lessons/create',[LessonController::class,'create'])->name('lessons.create');
    Route::post('/lessons/store',[LessonController::class,'store'])->name('lessons.store');
    Route::put('/lessons/edit/{lesson}',[LessonController::class,'edit'])->name('lessons.edit');
    Route::patch('/lessons/update/{lesson}',[LessonController::class,'update'])->name('lessons.update');
    Route::delete('/lessons/delete/{lesson}',[LessonController::class,'destroy'])->name('lesson.delete');

    Route::get('/list-exercises',[ListExerciseController::class,'index'])->name('list.exercises');
    Route::get('/list-exercises/create',[ListExerciseController::class,'create'])->name('list.exercises.create');
    Route::post('/list-exercises/store',[ListExerciseController::class,'store'])->name('list.exercises.store');
    Route::put('/list-exercises/edit/{exercise}',[ListExerciseController::class,'edit'])->name('list.exercises.edit');
    Route::delete('/list-exercises/delete/{list_exercise}',[ListExerciseController::class,'destroy'])->name('list.exercises.delete');

    Route::get('/languages',[LanguageController::class,'index'])->name('languages');
    Route::post('/language-store',[LanguageController::class,'store'])->name('language.store');
    Route::put('/language-active/{language}',[LanguageController::class,'active'])->name('language.active');
    Route::delete('/language/delete/{language}',[LanguageController::class,'destroy'])->name('language.delete');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
