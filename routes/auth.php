<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
// use App\Http\Controllers\Auth\ConfirmablePasswordController;
// use App\Http\Controllers\Auth\EmailVerificationNotificationController;
// use App\Http\Controllers\Auth\EmailVerificationPromptController;
// use App\Http\Controllers\Auth\NewPasswordController;
// use App\Http\Controllers\Auth\PasswordController;
// use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
<<<<<<< HEAD
// use App\Http\Controllers\Auth\VerifyEmailController;
=======
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\ChapterController;
use App\Http\Controllers\Exercises\VocabularyController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\ListExerciseController;
use App\Http\Controllers\Exercises\VideoController;
>>>>>>> 9fa6a0654b6b82e03ce2ee168abd5537e2946a96
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
    Route::get('/admin-controll',[AdminController::class,'index'])->name('admin.controll');
    Route::delete('admin/delete/{user}',[AdminController::class,'destroy'])->name('admin.delete');
    Route::put('/admin/edit/{user}',[AdminController::class,'edit'])->name('admin.edit');
    Route::patch('/admin/update/{user}',[AdminController::class,'update'])->name('admin.update');
    Route::post('register', [RegisteredUserController::class, 'store'])->name('register');

<<<<<<< HEAD
=======
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

    Route::group(['prefix' => 'list-exercises', 'as' => 'list.'], function(){
        Route::get('/',[ListExerciseController::class,'index'])->name('exercises');
        Route::get('/create',[ListExerciseController::class,'create'])->name('exercises.create');
        Route::post('/store',[ListExerciseController::class,'store'])->name('exercises.store');
        Route::put('/edit/{exercise}',[ListExerciseController::class,'edit'])->name('exercises.edit');
        Route::delete('/delete/{list_exercise}',[ListExerciseController::class,'destroy'])->name('exercises.delete');
    });
    

    Route::group(['prefix' => 'languages', 'as' => 'language.'], function () {
        Route::get('/', [LanguageController::class, 'index'])->name('index');
        Route::post('/store', [LanguageController::class, 'store'])->name('store');
        Route::put('/active/{language}', [LanguageController::class, 'active'])->name('active');
        Route::delete('/delete/{language}', [LanguageController::class, 'destroy'])->name('delete');
    });

    Route::group(['prefix'=> 'exercises/'], function () {   
        Route::group(['prefix'=> 'vocabulary','as'=> 'vocabulary.'], function () {   
            Route::get('/',[VocabularyController::class,'index'])->name('index');
            Route::get('/create',[VocabularyController::class,'create'])->name('create');
            Route::post('/store',[VocabularyController::class,'store'])->name('store');
        });
        Route::group(['prefix' => 'video', 'as' => 'video.'], function () {
            Route::get('/',[VideoController::class,'index'])->name('index');
            Route::get('/create',[VideoController::class,'create'])->name('create');
            Route::post('/store',[VideoController::class,'store'])->name('store');
            Route::put('/edit',[VideoController::class,'edit'])->name('edit');
            Route::put('/update',[VideoController::class,'update'])->name('update');
            Route::delete('/delete/{video}',[VideoController::class,'destroy'])->name('delete');

        });
    });
    

    
    






    // Route::get('/')->name;


>>>>>>> 9fa6a0654b6b82e03ce2ee168abd5537e2946a96

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
