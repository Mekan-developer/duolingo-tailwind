<?php

namespace App\Http\Controllers;

use App\Http\Requests\LessonRequest;
use App\Models\Chapter;
use App\Models\Language;
use App\Models\Lesson;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    public function index(){
        $lessons = Lesson::orderBy("order")->with('chapter')->get();

        $locales = Language::where("status",1)->get("locale");

        return view("pages.lessons.index", compact("locales","lessons"));
    }

    public function create(){ 
        $chapters = Chapter::orderBy('order')->get(); 
        $locales = Language::where("status",1)->orderBy('order')->get();

        return view("pages.lessons.create", compact("locales","chapters"));
    }

    public function store(LessonRequest $request){  
        Lesson::create($request->all());  

        return redirect()->route('lessons');
    }

    public function edit(Lesson $lesson){
        $chapters = Chapter::orderBy('order')->get(); 
        $lessons = Lesson::orderBy("order")->get();
        $locales = Language::where("status",1)->orderBy('order')->get();

        return view('pages.lessons.edit', compact('locales','chapters','lesson','lessons'));
    }

    public function update(LessonRequest $request, Lesson $lesson){ 
        $lessons = Lesson::all();
        $this->sortItems($lessons, $lesson->order, $request->order);

        $lesson->update($request->all());

        return redirect()->route('lessons');
    }


    public function destroy(Lesson $lesson){
        $orderDeletedRow = $lesson->order;
        $delete_success = $lesson->delete();

        // sorting order
        if( $delete_success ){
            $table = Chapter::orderBy('order', 'asc')->get();
            $this->reorderAfterRemoval($table,$orderDeletedRow);
        }
        // end sorting order

        return redirect()->route('lessons');
    }
}
