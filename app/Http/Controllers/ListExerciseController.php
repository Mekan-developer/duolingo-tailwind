<?php

namespace App\Http\Controllers;

use App\Models\Chapter;
use App\Models\Language;
use App\Models\Lesson;
use App\Models\List_exercise;
use Illuminate\Http\Request;

class ListExerciseController extends Controller
{
    public function index(){
        $locales = Language::where("status",1)->get("locale");
        $list_exercises = List_exercise::orderBy("order")->get();
        // dd($list_exercises);
        return view("pages.listExercises.index",compact("locales","list_exercises"));
    }

    public function create(){
        $chapters = Chapter::orderBy('order')->get(); 
        $lessons = Lesson::orderBy('order')->get(); 
        $locales = Language::where("status",1)->orderBy('order')->get("locale");

        return view("pages.listExercises.create",compact("locales","chapters","lessons"));
    }
}
