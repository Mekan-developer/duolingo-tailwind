<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\ChapterController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\ListExerciseController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    // Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])->name('password.request');
    // Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])->name('password.email');
    // Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])->name('password.reset');
    // Route::post('reset-password', [NewPasswordController::class, 'store'])->name('password.store');
    
});

Route::middleware('auth')->group(function () {
    Route::delete('admin/delete/{user}',[AdminController::class,'destroy'])->name('admin.delete');
    Route::post('register', [RegisteredUserController::class, 'store'])->name('register');

    Route::get('/chapters',[ChapterController::class,'index'])->name('chapters');
    Route::get('/chapters/create',[ChapterController::class,'create'])->name('chapter.create');
    Route::post('/chapters/store',[ChapterController::class,'store'])->name('chapter.store');
    Route::delete('/chapters/delete/{chapter}',[ChapterController::class,'destroy'])->name('chapter.delete');

    Route::get('/lessons',[LessonController::class,'index'])->name('lessons');
    Route::get('/lessons/create',[LessonController::class,'create'])->name('lessons.create');
    Route::post('/lessons/store',[LessonController::class,'store'])->name('lessons.store');
    Route::post('/lessons/delete/{lesson}',[LessonController::class,'destroy'])->name('lesson.delete');

    Route::get('/list-exercises',[ListExerciseController::class,'index'])->name('list.exercises');
    Route::get('/list-exercises/create',[ListExerciseController::class,'create'])->name('list.exercises.create');

    Route::get('/languages',[LanguageController::class,'index'])->name('languages');
    Route::post('/language-store',[LanguageController::class,'store'])->name('language.store');
    Route::put('/language-active/{language}',[LanguageController::class,'active'])->name('language.active');
    Route::delete('/language/delete/{language}',[LanguageController::class,'destroy'])->name('language.delete');

    // Route::get('/')->name;



    // Route::get('verify-email', EmailVerificationPromptController::class)->name('verification.notice');
    // Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
    //             ->middleware(['signed', 'throttle:6,1'])->name('verification.verify');
    // Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
    //             ->middleware('throttle:6,1')->name('verification.send');
    // Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])->name('password.confirm');
    // Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);
    // Route::put('password', [PasswordController::class, 'update'])->name('password.update');
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
});
