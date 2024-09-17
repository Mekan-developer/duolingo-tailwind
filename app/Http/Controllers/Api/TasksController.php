<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\GrammarResource;
use App\Http\Resources\ListeningResource;
use App\Http\Resources\PhoneticResource;
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
use App\Models\Grammar;
use App\Models\Listening;
use App\Models\Phonetics;
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
     * @OA\Get(
     *      path="/exercises/vocabulary",
     *      tags={"1.vocabulary (1.Лексика)"},
     *      summary="first task of exercise",
     *      description="первое задание по упражнению",
     *      @OA\Response(response=200,description="vocabulary retrived successfully")
     * )
     */


    public function vocabulary(){
        $apiData = VocabularyResource::collection(Vocabulary::where('status',true)->orderBy('order')->get());
        return response()->json($apiData,200);
    }

     /**
     * @OA\Get(
     *      path="/exercises/translation-test1",
     *      tags={"2.Vocabulary (2.Лексика)"},
     *      summary="third task of exercise",
     *      description="третье задание упражнения, Лексика",
     *      @OA\Response(response=200,description="translation-test1 retrived successfully")
     * )
     */

     public function translationTest1(){
        $apiData = TranslationTestResource::collection(QuestionWord::where('status',true)->orderBy('order')->get());
        return response()->json($apiData,200);
    }

    /**
     * @OA\Get(
     *      path="/exercises/video",
     *      tags={"3.video (3.Видео)"},
     *      summary="second task of exercise",
     *      description="второе задание упражнения, Видео",
     *      @OA\Response(response=200,description="video retrived successfully")
     * )
     */

    public function video(){
        $apiData = VideoResource::collection(Video::where('status',true)->orderBy('order')->get());
        return response()->json($apiData,200);
    }

    /**
     * @OA\Get(
     *      path="/exercises/translation",
     *      tags={"4.translation (4.Перевод)"},
     *      summary="fourth task of exercise",
     *      description="четвертый задание упражнения, Перевод",
     *      @OA\Response(response=200,description="translation retrived successfully")
     * )
     */

    public function translation(){
        $apiData = TranslationResource::collection(AudioTranslation::where('status',true)->orderBy('order')->get());
        return response()->json($apiData,200);
    }

    /**
     * @OA\Get(
     *      path="/exercises/question-image",
     *      tags={"5.Vocabulary (5.Лексика)"},
     *      summary="fifth task of exercise",
     *      description="пятое задание упражнения, Лексика",
     *      @OA\Response(response=200,description="question-image retrived successfully")
     * )
     */

    public function questionImage(){
        $apiData = QuestionImageResource::collection(QuestionImage::where('status',true)->orderBy('order')->get());
        return response()->json($apiData,200);
    }

    
    /**
     * @OA\Get(
     *      path="/exercises/vocabulary-spelling",
     *      tags={"6.Vocabulary with spelling, (6.Лексика с орфографией)"},
     *      summary="eleventh task of the exercise",
     *      description="одиннадцатое задание учения, Лексика с орфографией",
     *      @OA\Response(response=200,description="vocabulary-spelling retrived successfully")
     * )
     */

     public function vocabularySpelling(){
        $apiData = SpellingResource::collection(Spelling::where('status',true)->orderBy('order')->get());
        return response()->json($apiData,200);
    }


    /**
     * @OA\Get(
     *      path="/exercises/pronunciation",
     *      tags={"7.Vocabulary with pronunciation, (7. Лексика с произношением)"},
     *      summary="seventh task of exercise",
     *      description="седьмое задание упражнения,Лексика с произношением",
     *      @OA\Response(response=200,description="pronunciation retrived successfully")
     * )
     */
    public function pronunciation(){
        $apiData = PronunciationResource::collection(Pronunciation::where('status',true)->orderBy('order')->get());
        return response()->json($apiData,200);
    }

    /**
     * @OA\Get(
     *      path="/exercises/grammar-theory",
     *      tags={"8.grammar theory with practics, (8. теория грамматики с практикой)"},
     *      summary="eighth task of the exercise",
     *      description="восьмое задание упражнения, теория грамматики с практикой",
     *      @OA\Response(response=200,description="grammar-theory retrived successfully")
     * )
     */


    public function grammarTeory(){
        $apiData = GrammarResource::collection(Grammar::where('status',true)->orderBy('order')->get());
        return response()->json($apiData,200);
    }

    /**
     * @OA\Get(
     *      path="/exercises/audio-question",
     *      tags={"9.Vocabulary, (9.Лексика)"},
     *      summary="ninth task of the exercise",
     *      description="девятое задание учения, Лексика",
     *      @OA\Response(response=200,description="audio-question retrived successfully")
     * )
     */


    public function audioQuestion(){
        $apiData = TestImageResource::collection(TestImage::where('status',true)->orderBy('order')->get());
        return response()->json($apiData,200);
    }

    /**
     * @OA\Get(
     *      path="/exercises/translation-test2",
     *      tags={"10.Vocabulary, (10.Лексика)"},
     *      summary="tenth task of the exercise",
     *      description="десятое задание упражнения, Лексика",
     *      @OA\Response(response=200,description="translation-test2 retrived successfully")
     * )
     */

    public function translationTest2(){
        $apiData = TestWordResource::collection(TestWord::where('status',true)->orderBy('order')->get());
        return response()->json($apiData,200);
    }

    /**
     * @OA\Get(
     *      path="/exercises/listening",
     *      tags={"11.Listening, (11.Аудирование)"},
     *      summary="twelfth task of the exercise",
     *      description="двенадцатое задание упражнения, Аудирование",
     *      @OA\Response(response=200,description="listening retrived successfully")
     * )
     */

    public function listening(){
        $apiData = ListeningResource::collection(Listening::where('status',true)->orderBy('order')->get());
        return response()->json($apiData,200);
    }


}
