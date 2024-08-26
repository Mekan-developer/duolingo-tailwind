<?php

namespace App\Http\Controllers;

use App\Http\Requests\ListExerciseRequest;
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

    public function store(ListExerciseRequest $request){
        
        List_exercise::create($request->all());

        return redirect()->route("list.exercises")->with("success","Lists of exercise successfully added!");

    }

    public function destroy(List_exercise $list_exercise){
        $orderDeletedRow = $list_exercise->order;
        $delete_success = $list_exercise->delete();

        // sorting order
        if( $delete_success ){
            $table = Chapter::orderBy('order', 'asc')->get();
            $this->reorderAfterRemoval($table,$orderDeletedRow);
        }
        // end sorting order

        return redirect()->route('lessons');
    }
}
