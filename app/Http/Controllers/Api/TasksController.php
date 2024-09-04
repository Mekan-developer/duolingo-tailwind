<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ListeningResource;
use App\Http\Resources\PronunciationResource;
use App\Http\Resources\QuestionImageResource;
use App\Http\Resources\SpellingResource;
use App\Http\Resources\TestImageResource;
use App\Http\Resources\TestWordResource;
use App\Http\Resources\TranslationResource;
use App\Http\Resources\TranslationTestResource;
use App\Http\Resources\VideoResource;
use App\Http\Resources\VocabularyResource;
use App\Models\AudioTranslation;
use App\Models\Listening;
use App\Models\Pronunciation;
use App\Models\QuestionImage;
use App\Models\QuestionWord;
use App\Models\Spelling;
use App\Models\TestImage;
use App\Models\TestWord;
use App\Models\Video;
use App\Models\Vocabulary;

class TasksController extends Controller
{

/**
 * @SWG\Get(
 *     path="/exercises/vocabulary",
 *     summary="Get a list of vocabulary",
 *     tags={"Exercises"},
 *     @SWG\Response(response=200, description="Successful operation"),
 *     @SWG\Response(response=400, description="Invalid request")
 * )
 */
    public function vocabulary(){
        $apiData = VocabularyResource::collection(Vocabulary::where('status',true)->orderBy('order')->get());
        return response()->json($apiData,200);
    }

    public function video(){
        $apiData = VideoResource::collection(Video::where('status',true)->orderBy('order')->get());
        return response()->json($apiData,200);
    }

    public function translationTest1(){
        $apiData = TranslationTestResource::collection(QuestionWord::where('status',true)->orderBy('order')->get());
        return response()->json($apiData,200);
    }

    public function translation(){
        $apiData = TranslationResource::collection(AudioTranslation::where('status',true)->orderBy('order')->get());
        return response()->json($apiData,200);
    }

    public function questionImage(){
        $apiData = QuestionImageResource::collection(QuestionImage::where('status',true)->orderBy('order')->get());
        return response()->json($apiData,200);
    }

    // public function phonetics(){
    //     $apiData = QuestionImageResource::collection(QuestionImage::where('status',true)->orderBy('order')->get());
    //     return response()->json($apiData,200);
    // }

    public function pronunciation(){
        $apiData = PronunciationResource::collection(Pronunciation::where('status',true)->orderBy('order')->get());
        return response()->json($apiData,200);
    }

    // public function grammarTeory(){
    //     $apiData = QuestionImageResource::collection(QuestionImage::where('status',true)->orderBy('order')->get());
    //     return response()->json($apiData,200);
    // }

    public function audioQuestion(){
        $apiData = TestImageResource::collection(TestImage::where('status',true)->orderBy('order')->get());
        return response()->json($apiData,200);
    }

    public function translationTest2(){
        $apiData = TestWordResource::collection(TestWord::where('status',true)->orderBy('order')->get());
        return response()->json($apiData,200);
    }

    public function vocabularySpelling(){
        $apiData = SpellingResource::collection(Spelling::where('status',true)->orderBy('order')->get());
        return response()->json($apiData,200);
    }

    public function listening(){
        $apiData = ListeningResource::collection(Listening::where('status',true)->orderBy('order')->get());
        return response()->json($apiData,200);
    }


}
