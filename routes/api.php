<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ChapterController;
use App\Http\Controllers\Api\ExerciseTypeController;
use App\Http\Controllers\Api\InformationController;
use App\Http\Controllers\Api\LanguageController;
use App\Http\Controllers\Api\LessonController;
use App\Http\Controllers\Api\ListExerciseController;
use App\Http\Controllers\api\TasksController;
use App\Http\Middleware\AuthenticateOnceWithBasicAuth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');    
});

// http://127.0.0.1:8000/api/documentation


Route::get('/langs',[LanguageController::class,'index']);

// Route::middleware('auth:sanctum')->group(function () {
    Route::get('/chapters',[ChapterController::class,'index']);
    Route::get('/lessons',[LessonController::class,'index']); 
    Route::get('/list-exercise',[ListExerciseController::class,'index']);
    Route::get('/exercise-types',[ExerciseTypeController::class,'index']);
    Route::get('/informations',[InformationController::class,'index']);
    
    Route::group(['prefix' => 'exercises/'],function(){
        Route::get('vocabulary',[TasksController::class,'vocabulary']);//1
        Route::get('video',[TasksController::class,'video']);//2
        Route::get('translation-test1',[TasksController::class,'translationTest1']);//3
        Route::get('translation',[TasksController::class,'translation']);//4
        Route::get('question-image',[TasksController::class,'questionImage']);//5
        Route::get('phonetics',[TasksController::class,'phonetics']);//6
        Route::get('pronunciation',[TasksController::class,'pronunciation']);//7
        Route::get('grammar-theory',[TasksController::class,'grammarTeory']);//8
        Route::get('audio-question',[TasksController::class,'audioQuestion']);//9
        Route::get('translation-test2',[TasksController::class,'translationTest2']);//10
        Route::get('vocabulary-spelling',[TasksController::class,'vocabularySpelling']);//11
        Route::get('listening',[TasksController::class,'listening']);//12
    });
// })->middleware(AuthenticateOnceWithBasicAuth::class);



