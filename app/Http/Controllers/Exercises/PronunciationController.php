<?php

namespace App\Http\Controllers\Exercises;

use App\Http\Controllers\Controller;
use App\Http\Requests\PronunciationRequest;
use App\Models\Language;
use App\Models\Pronunciation;
use Illuminate\Http\Request;
use Storage;

class PronunciationController extends Controller
{
    public function index(Request $request){
        $pronunciations = Pronunciation::orderBy('order')->get();
        $data = $this->selectOPtionOrderExercise($request,$pronunciations,'pronunciations');
       
        return view("pages.allExercises.pronunciation.index", $data);
    }

    public function create(){


        return view("pages.allExercises.pronunciation.create");
    }

    public function store(PronunciationRequest $request){
        $data = [
            'chapter_id' => $request->chapter_id,
            'lesson_id' => $request->lesson_id,
            'exercise_id' => $request->exercise_id,
        ];
        if ($request->hasFile('audio')) {
            $random = hexdec(uniqid());
            $filename = $random . '.' . $request->audio->extension();
            Storage::disk('pronunciation')->putFileAs('', $request->audio,$filename);
            $data['audio'] = $filename;
        }
        $message = 'Pronunciation created sccessfully!';
        Pronunciation::create($data);

        return redirect()->route('pronunciation.index')->with('success',$message);    
    }

    public function edit(Pronunciation $pronunciation){ 
        dd('edit not created yet');
     }

     public function update(PronunciationRequest $request, Pronunciation $pronunciation){   

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
