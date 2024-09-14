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
        
        // for ordering start
        $chapters = Chapter::orderBy('order')->get(); 
        $selected_chapter_id = null;
        if($request->has('sort_by_chapter') && $request->sort_by_chapter > 0 ){
            $lessons = Lesson::where('chapter_id',$request->sort_by_chapter)->orderBy("order")->with('chapter')->get();
            $list_exercises = List_exercise::where('chapter_id',$request->sort_by_chapter)->orderBy("order")->with('lesson')->paginate(10);
        }else{
            $lessons = Lesson::orderBy("order")->with('chapter')->get();
            $list_exercises = List_exercise::orderBy("order")->with('lesson')->paginate(10);
        }

        if($request->has('sort_by_lesson') && $request->sort_by_lesson > 0 ){
            $selected_lesson = $lessons->where('id',$request->sort_by_lesson)->first();
            $selected_chapter_id = $selected_lesson['chapter_id'];
            $list_exercises = List_exercise::where('lesson_id',$request->sort_by_lesson)->orderBy("order")->with('lesson')->paginate(10);
        }
        // ordering end

        return view("pages.listExercises.index",compact("locales","list_exercises","chapters","lessons","selected_chapter_id"));
    }

    public function create(){
        $chapters = Chapter::whereHas('lesson')->orderBy('order')->get(); 
        $lessons = Lesson::orderBy('order')->get(); 
        $locales = Language::where("status",1)->orderBy('order')->get();

        return view("pages.listExercises.create",compact("locales","chapters","lessons"));
    }

    public function store(ListExerciseRequest $request){

        List_exercise::create([
            'lesson_id' => $request->lesson_id,
            'chapter_id' => $request->chapter_id,
            'name' => $request->name,
            // 'title' => $request->title,
        ]);
        
        return redirect()->route("list.exercises")->with("success","Lists of exercise successfully created!");

    }

    public function edit(List_exercise $list_exercise){
        $lessons = Lesson::where('chapter_id',$list_exercise->chapter_id)->orderBy('order')->get(); 

        
        return view("pages.listExercises.edit")->with('list_exercise',$list_exercise)->with('lessons',$lessons);

    }

    public function update(ListExerciseRequest $request,List_exercise $list_exercise){
        $List_exercises = List_exercise::all();
        $this->sortItems($List_exercises, $list_exercise->order, $request->order);
        $list_exercise->update($request->all());

        return redirect()->route('list.exercises')->with('success','Exercise updated successfully!');
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

        return redirect()->route('lessons')->with('success','Lists of exercise updated successfully!');
    }
}
