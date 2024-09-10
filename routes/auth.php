<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\ChapterController;
use App\Http\Controllers\BackUpsController;
use App\Http\Controllers\Exercises\AudioTranslationController;
use App\Http\Controllers\Exercises\GrammarController;
use App\Http\Controllers\Exercises\ListeningController;
use App\Http\Controllers\Exercises\PronunciationController;
use App\Http\Controllers\Exercises\QuestionsImageController;
use App\Http\Controllers\Exercises\TestImageController;
use App\Http\Controllers\Exercises\VocabularyController;
use App\Http\Controllers\InformationController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\ListExerciseController;
use App\Http\Controllers\Exercises\VideoController;
use App\Http\Controllers\Exercises\QuestionWordController;
use App\Http\Controllers\Exercises\TestWordController;
use App\Http\Controllers\Exercises\SpellingController;


use App\Http\Controllers\Exercises\PhoneticsController;
use App\Http\Controllers\UserProfileController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('login', [AuthenticatedSessionController::class, 'store']);
});

Route::middleware('auth')->group(function () {
    Route::get('/download-database', [BackUpsController::class, 'download'])->name('download.database');
    Route::get('/download-files', [BackUpsController::class, 'downloadFiles'])->name('download.files');

    Route::group(['prefix'=> '/accounts'], function () { 
        Route::get('/profile',[UserProfileController::class,'edit'])->name('profile.edit');
        Route::post('/profile',[UserProfileController::class,'profileUpdate'])->name('profile.update');

        Route::get('/admin-controll',[AdminController::class,'index'])->name('admin.controll');
        Route::delete('admin/delete/{user}',[AdminController::class,'destroy'])->name('admin.delete');
        Route::get('/admin/edit/{user}',[AdminController::class,'edit'])->name('admin.edit');
        Route::patch('/admin/update/{user}',[AdminController::class,'update'])->name('admin.update');
        Route::post('register', [RegisteredUserController::class, 'store'])->name('register');
    })->name('accounts');

    Route::get('/chapters',[ChapterController::class,'index'])->name('chapters');
    Route::get('/chapters/create',[ChapterController::class,'create'])->name('chapter.create');
    Route::post('/chapters/store',[ChapterController::class,'store'])->name('chapter.store');
    Route::get('/chapters/edit/{chapter}',[ChapterController::class,'edit'])->name('chapter.edit');
    Route::patch('/chapters/update/{chapter}',[ChapterController::class,'update'])->name('chapter.update');
    Route::delete('/chapters/delete/{chapter}',[ChapterController::class,'destroy'])->name('chapter.delete');

    Route::get('/lessons',[LessonController::class,'index'])->name('lessons');
    Route::get('/lessons/create',[LessonController::class,'create'])->name('lessons.create');
    Route::post('/lessons/store',[LessonController::class,'store'])->name('lessons.store');
    Route::get('/lessons/edit/{lesson}',[LessonController::class,'edit'])->name('lessons.edit');
    Route::patch('/lessons/update/{lesson}',[LessonController::class,'update'])->name('lessons.update');
    Route::delete('/lessons/delete/{lesson}',[LessonController::class,'destroy'])->name('lesson.delete');

    Route::group(['prefix' => 'list-exercises', 'as' => 'list.'], function(){
        Route::get('/',[ListExerciseController::class,'index'])->name('exercises');
        Route::get('/create',[ListExerciseController::class,'create'])->name('exercises.create');
        Route::post('/store',[ListExerciseController::class,'store'])->name('exercises.store');
        Route::get('/edit/{list_exercise}',[ListExerciseController::class,'edit'])->name('exercises.edit');
        Route::patch('/edit/{list_exercise}',[ListExerciseController::class,'update'])->name('exercises.update');
        Route::delete('/delete/{list_exercise}',[ListExerciseController::class,'destroy'])->name('exercises.delete');
    });

    Route::group(['prefix' => 'informations', 'as' => 'information.'], function(){
        Route::get('/',[InformationController::class,'index'])->name('index');
        Route::get('/create',[InformationController::class,'create'])->name('create');
        Route::post('/store',[InformationController::class,'store'])->name('store');
        // Route::get('/edit/{list_exercise}',[ListExerciseController::class,'edit'])->name('exercises.edit');
        // Route::patch('/edit/{list_exercise}',[ListExerciseController::class,'update'])->name('exercises.update');
        // Route::delete('/delete/{list_exercise}',[ListExerciseController::class,'destroy'])->name('exercises.delete');
    });
    
    Route::group(['prefix' => 'languages', 'as' => 'language.'], function () {
        Route::get('/', [LanguageController::class, 'index'])->name('index');
        Route::post('/store', [LanguageController::class, 'store'])->name('store');
        Route::get('/edit/{language}', [LanguageController::class, 'edit'])->name('edit');
        Route::patch('/update', [LanguageController::class, 'update'])->name('update');
        Route::put('/active/{language}', [LanguageController::class, 'active'])->name('active');
        Route::delete('/delete/{language}', [LanguageController::class, 'destroy'])->name('delete');
    });

    
    Route::group(['prefix'=> 'exercises/'], function () {  

        //WORD 
        Route::group(['prefix'=> 'vocabulary','as'=> 'vocabulary.'], function () {   
            Route::get('/',[VocabularyController::class,'index'])->name('index');
            Route::get('/create',[VocabularyController::class,'create'])->name('create');
            Route::post('/store',[VocabularyController::class,'store'])->name('store');
            Route::get('/edit/{vocabulary}',[VocabularyController::class,'edit'])->name('edit');
            Route::patch('/update/{vocabulary}',[VocabularyController::class,'update'])->name('update');
            Route::put('/active/{vocabulary}', [VocabularyController::class, 'active'])->name('active');
            Route::delete('/delete/{vocabulary}',[VocabularyController::class,'destroy'])->name('delete');

        });

        //VIDEO
        Route::group(['prefix' => 'video', 'as' => 'video.'], function () {
            Route::get('/',[VideoController::class,'index'])->name('index');
            Route::get('/create',[VideoController::class,'create'])->name('create');
            Route::post('/store',[VideoController::class,'store'])->name('store');
            Route::get('/edit/{video}',[VideoController::class,'edit'])->name('edit');
            Route::patch('/update/{video}',[VideoController::class,'update'])->name('update');
            Route::put('/active/{video}', [VideoController::class, 'active'])->name('active');
            Route::delete('/delete/{video}',[VideoController::class,'destroy'])->name('delete');
        });

        //QUESTION_WORD
        Route::group(['prefix'=> 'question-word','as' => 'questionWord.'], function () {
            Route::get('/',[QuestionWordController::class,'index'])->name('index');
            Route::get('/create',[QuestionWordController::class,'create'])->name('create');
            Route::post('/store',[QuestionWordController::class,'store'])->name('store');
            Route::get('/edit/{questionWord}',[QuestionWordController::class,'edit'])->name('edit');
            Route::patch('/update/{questionWord}',[QuestionWordController::class,'update'])->name('update');
            Route::put('/active/{questionWord}', [QuestionWordController::class, 'active'])->name('active');
            Route::delete('/delete/{questionWord}',[QuestionWordController::class,'destroy'])->name('delete');
        });

        //AUDIO_TRANSLATIONS
        Route::group(['prefix'=> 'audio-translation','as' => 'audioTranslation.'], function () {
            Route::get('/',[AudioTranslationController::class,'index'])->name('index');
            Route::get('/create',[AudioTranslationController::class,'create'])->name('create');
            Route::post('/store',[AudioTranslationController::class,'store'])->name('store');
            Route::get('/edit/{audioTranslation}',[AudioTranslationController::class,'edit'])->name('edit');
            Route::patch('/update/{audioTranslation}',[AudioTranslationController::class,'update'])->name('update');
            Route::put('/active/{audioTranslation}', [AudioTranslationController::class, 'active'])->name('active');
            Route::delete('/delete/{audioTranslation}',[AudioTranslationController::class,'destroy'])->name('delete');
        });

        //QUESTION_IMAGE
        Route::group(['prefix'=> 'question-image','as' => 'questionImage.'], function () {
            Route::get('/',[QuestionsImageController::class,'index'])->name('index');
            Route::get('/create',[QuestionsImageController::class,'create'])->name('create');
            Route::post('/store',[QuestionsImageController::class,'store'])->name('store');
            Route::get('/edit/{questionImage}',[QuestionsImageController::class,'edit'])->name('edit');
            Route::patch('/update/{questionImage}',[QuestionsImageController::class,'update'])->name('update');
            Route::put('/active/{questionImage}', [QuestionsImageController::class, 'active'])->name('active');
            Route::delete('/delete/{questionImage}',[QuestionsImageController::class,'destroy'])->name('delete');
        });

        //PHONETICS
        Route::group(['prefix' => 'phonetics', 'as' => 'phonetics.'], function() {
            Route::get('/',[PhoneticsController::class,'index'])->name('index');//+
            Route::get('/create',[PhoneticsController::class,'create'])->name('create');//+
            Route::post('/store',[PhoneticsController::class,'store'])->name('store');//+
            Route::get('/edit/{phonetics}',[PhoneticsController::class,'edit'])->name('edit');
            Route::patch('/update/{phonetics}',[PhoneticsController::class,'update'])->name('update');
            Route::put('/active/{phonetics}', [PhoneticsController::class, 'active'])->name('active');
            Route::delete('/delete/{phonetics}',[PhoneticsController::class,'destroy'])->name('delete');//+
        });

        //PRONUNCIATION
        Route::group(['prefix' => 'pronunciation', 'as' => 'pronunciation.'], function() {
            Route::get('/',[PronunciationController::class,'index'])->name('index');
            Route::get('/create',[PronunciationController::class,'create'])->name('create');
            Route::post('/store',[PronunciationController::class,'store'])->name('store');
            Route::get('/edit/{pronunciation}',[PronunciationController::class,'edit'])->name('edit');
            Route::patch('/update/{pronunciation}',[PronunciationController::class,'update'])->name('update');
            Route::put('/active/{pronunciation}', [PronunciationController::class, 'active'])->name('active');
            Route::delete('/delete/{pronunciation}',[PronunciationController::class,'destroy'])->name('delete');
        });

        //GRAMMAR_THEORY
        Route::group(['prefix' => 'grammar', 'as' => 'grammar.'], function() {
            Route::get('/',[GrammarController::class,'index'])->name('index');
            Route::get('/create',[GrammarController::class,'create'])->name('create');
            Route::post('/store',[GrammarController::class,'store'])->name('store');
            Route::get('/edit',[GrammarController::class,'edit'])->name('edit');
            Route::patch('/update',[GrammarController::class,'update'])->name('update');
            Route::put('/active/{grammar}', [GrammarController::class, 'active'])->name('active');
            Route::delete('/delete/{grammar}',[GrammarController::class,'destroy'])->name('delete');//+
        }); 

        //VOCABULARY_AUDIO_IMAGE
        Route::group(['prefix' => 'test-image', 'as' => 'testImage.'], function() {
            Route::get('/',[TestImageController::class,'index'])->name('index');
            Route::get('/create',[TestImageController::class,'create'])->name('create');
            Route::post('/store',[TestImageController::class,'store'])->name('store');
            Route::get('/edit/{testImage}',[TestImageController::class,'edit'])->name('edit');
            Route::patch('/update/{testImage}',[TestImageController::class,'update'])->name('update');
            Route::put('/active/{testImage}', [TestImageController::class, 'active'])->name('active');
            Route::delete('/delete/{testImage}',[TestImageController::class,'destroy'])->name('delete');
        });

        //VOCABULARY_AUDIO_WORD
        Route::group(['prefix' => 'test-word', 'as' => 'testWord.'], function() {
            Route::get('/',[TestWordController::class,'index'])->name('index');
            Route::get('/create',[TestWordController::class,'create'])->name('create');
            Route::post('/store',[TestWordController::class,'store'])->name('store');
            Route::get('/edit/{testWord}',[TestWordController::class,'edit'])->name('edit');
            Route::patch('/update/{testWord}',[TestWordController::class,'update'])->name('update');
            Route::put('/active/{testWord}', [TestWordController::class, 'active'])->name('active');
            Route::delete('/delete/{testWord}',[TestWordController::class,'destroy'])->name('delete');
        });

        //SPELLING
        Route::group(['prefix' => 'spelling', 'as' => 'spelling.'], function() {
            Route::get('/',[SpellingController::class,'index'])->name('index');
            Route::get('/create',[SpellingController::class,'create'])->name('create');
            Route::post('/store',[SpellingController::class,'store'])->name('store');
            Route::get('/edit/{spelling}',[SpellingController::class,'edit'])->name('edit');
            Route::patch('/update/{spelling}',[SpellingController::class,'update'])->name('update');
            Route::put('/active/{spelling}', [SpellingController::class, 'active'])->name('active');
            Route::delete('/delete/{spelling}',[SpellingController::class,'destroy'])->name('delete');
        });

        //LISTENING
        Route::group(['prefix' => 'listening', 'as' => 'listening.'], function() {
            Route::get('/',[ListeningController::class,'index'])->name('index');
            Route::get('/create',[ListeningController::class,'create'])->name('create');
            Route::post('/store',[ListeningController::class,'store'])->name('store');
            Route::get('/edit/{listening}',[ListeningController::class,'edit'])->name('edit');
            Route::patch('/update/{listening}',[ListeningController::class,'update'])->name('update');
            Route::put('/active/{listening}', [ListeningController::class, 'active'])->name('active');
            Route::delete('/delete/{listening}',[ListeningController::class,'destroy'])->name('delete');
        });

        

               
    });
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
});
