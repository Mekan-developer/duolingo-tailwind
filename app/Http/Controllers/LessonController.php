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
        dd($lessons);
        $locales = Language::where("status",1)->get("locale");

        return view("pages.lessons.index", compact("locales","lessons"));
    }

    public function create(){ 
        $chapters = Chapter::orderBy('order')->get(); 
        $locales = Language::where("status",1)->orderBy('order')->get("locale");

        return view("pages.lessons.create", compact("locales","chapters"));
    }

    public function store(LessonRequest $request){  
        Lesson::create($request->all());  

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
