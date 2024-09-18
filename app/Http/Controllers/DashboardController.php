<?php

namespace App\Http\Controllers;

use App\Models\AudioTranslation;
use App\Models\Chapter;
use App\Models\Exercise;
use App\Models\Grammar;
use App\Models\Information;
use App\Models\Language;
use App\Models\Lesson;
use App\Models\List_exercise;
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
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $chapters = Chapter::count();
        $lessons = Lesson::count();
        $exercises = Exercise::count();
            $vocabulary1 = Vocabulary::count();
            $video2 = Video::count();
            $vocabulary3 = TestWord::count();
            $translation4 = AudioTranslation::count();
            $vocabulary5 = QuestionImage::count();

            $vocabulary7 = Pronunciation::count();
            $grammar8 = Grammar::count();
            $vocabulary9 = TestImage::count();
            $vocabulary10 = QuestionWord::count();
            $vocabulary11 = Spelling::count();
            $listening12 = Listening::count();
        $allExercises = $vocabulary1 + $video2 + $vocabulary3 + $translation4 + $vocabulary5 + 
                        $vocabulary7 + $grammar8 + $vocabulary9 +  $vocabulary10 + $vocabulary11 + $listening12;

        $informations = Information::count();
        $languages = Language::count();


        return view('dashboard',compact('chapters','lessons','exercises','allExercises','informations','languages'));
    }
}
