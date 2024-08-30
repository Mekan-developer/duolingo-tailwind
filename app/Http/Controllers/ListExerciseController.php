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
    public function index(Request $request){
        $locales = Language::where("status",1)->get("locale");
        $list_exercises = List_exercise::orderBy("order")->with('lesson')->paginate(10);

        // if($request->has('sort_by_chapter') && $request->sort_by_chapter > 0 ){
        //     $lessons = Lesson::where('chapter_id',$request->sort_by)->orderBy("order")->with('chapter')->get();
        // }else{
        //     $lessons = Lesson::orderBy("order")->with('chapter')->get();
        // }

        return view("pages.listExercises.index",compact("locales","list_exercises"));
    }

    public function create(){
        $chapters = Chapter::whereHas('lesson')->orderBy('order')->get(); 
        $lessons = Lesson::orderBy('order')->get(); 
        $locales = Language::where("status",1)->orderBy('order')->get();

        return view("pages.listExercises.create",compact("locales","chapters","lessons"));
    }

    public function store(ListExerciseRequest $request){
        
        List_exercise::create($request->all());

        return redirect()->route("list.exercises")->with("success","Lists of exercise successfully added!");

    }

    public function edit(List_exercise $list_exercise){
        // $chapters = Chapter::whereHas('lesson')->orderBy('order')->get(); 
        // $lessons = Lesson::orderBy('order')->get(); 
        // $locales = Language::where("status",1)->orderBy('order')->get();

        // return view("pages.listExercises.edit",compact("locales","list_exercise","chapters","lessons"));

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
