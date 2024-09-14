<?php

namespace App\Http\Controllers\Exercises;

use App\Http\Controllers\Controller;
use App\Http\Requests\PronunciationRequest;
use App\Models\Language;
use App\Models\Lesson;
use App\Models\List_exercise;
use App\Models\Pronunciation;
use Illuminate\Http\Request;
use Storage;

class PronunciationController extends Controller
{
    public function index(Request $request){
        $pronunciations = Pronunciation::orderBy('order');
        $data = $this->selectOPtionOrderExercise($request,$pronunciations,'pronunciations');
       
        return view("pages.allExercises.pronunciation.index", $data);
    }

    public function create(){


        return view("pages.allExercises.pronunciation.create");
    }

    public function store(PronunciationRequest $request){

        $data = $request->all();
        if ($request->hasFile('audio')) {
            $random = hexdec(uniqid());
            $filename = $random . '.' . $request->audio->extension();
            Storage::disk('pronunciation')->putFileAs('', $request->audio,$filename);
            $data['audio'] = $filename;
        }
        Pronunciation::create($data);

        return redirect()->route('pronunciation.index')->with('success','Pronunciation created sccessfully!');    
    }

    public function edit(Pronunciation $pronunciation){ 

        $lessons = Lesson::where('chapter_id', $pronunciation->chapter_id)->whereHas('listExercise')->orderBy('order')->get();
        $exercises = List_exercise::where('lesson_id', $pronunciation->lesson_id)->orderBy('order')->get();

        return view("pages.allExercises.pronunciation.edit")->with("pronunciation",$pronunciation)->with("lessons",$lessons)->with("exercises", $exercises);
     }

     public function update(PronunciationRequest $request, Pronunciation $pronunciation){ 

        $pronunciations = Pronunciation::all();
        $this->sortItems($pronunciations, $pronunciation->order, $request->order);

        $data = $request->all();
        if ($request->hasFile('audio')) {
            if ($pronunciation->audio) {
                $this->removeFile($pronunciation->audio, 'pronunciation');
            } 
            $random = hexdec(uniqid());
            $filename = $random . '.' . $request->audio->extension();
            Storage::disk('pronunciation')->putFileAs('', $request->audio,$filename);
            $data['audio'] = $filename;
        }

        $pronunciation->update($data);
        return redirect()->route('pronunciation.index')->with('success','Pronunciation updated sccessfully!'); 
     }

     public function destroy(Pronunciation $pronunciation){
        if ($pronunciation->audio) {
            $this->removeFile($pronunciation->audio, 'pronunciation');
        } 
        $orderDeletedRow = $pronunciation->order;
        $delete_success = $pronunciation->delete();

        // sorting order
        if( $delete_success ){
            $table = Pronunciation::orderBy('order', 'asc')->get();
            $this->reorderAfterRemoval($table,$orderDeletedRow);
        }

        return redirect()->route('pronunciation.index')->with('success','Pronunciation deleted successfully');
    }

    public function active(Pronunciation $pronunciation){

        if($pronunciation->status == '1'){
            $pronunciation->status = '0';
        }else{
            $pronunciation->status = '1';
        }
            $pronunciation->save();

        return redirect()->route('pronunciation.index');
    }
}
