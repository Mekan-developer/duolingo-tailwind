<?php

use App\Http\Controllers\Api\ChapterController;
use App\Http\Controllers\Api\LanguageController;
use App\Http\Controllers\Api\LessonController;
use App\Http\Controllers\Api\ListExerciseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('/langs',[LanguageController::class,'index']);
Route::get('/chapters',[ChapterController::class,'index']);
Route::get('/lessons',[LessonController::class,'index']);
Route::get('/list-exercise',[ListExerciseController::class,'index']);

