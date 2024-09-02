<?php

namespace App\Http\Controllers\Exercises;

use App\Http\Controllers\Controller;
use App\Http\Requests\ListeningRequest;
use App\Models\Language;
use App\Models\Listening;
use Illuminate\Http\Request;
use Storage;

class ListeningController extends Controller
{
    public function index(Request $request){
        $listenings = Listening::orderBy('order')->get();
        $data = $this->selectOPtionOrderExercise($request,$listenings,'listenings');

        return view("pages.allExercises.listening.index",$data);
    }

    public function create() {
        $locales = Language::where("status",1)->orderBy('order')->get();

        return view("pages.allExercises.listening.create", compact("locales"));
    }

    public function store(ListeningRequest $request) {
        $data = [
            'chapter_id' => $request->chapter_id,
            'lesson_id' => $request->lesson_id,
            'exercise_id' => $request->exercise_id,
        ];

        if ($request->hasFile('audio')) {
            $random = hexdec(uniqid());
            $filename = $random . '.' . $request->audio->extension();
            Storage::disk('listening')->putFileAs('', $request->audio,$filename);
            $data['audio'] = $filename;
        }
        Listening::create($data);
        return redirect()->route('listening.index')->with('success','listening audio successfully created!');
    }

    public function destroy(Listening $listening){
        if ($listening->audio) {
            $this->removeFile($listening->audio, 'listening');
        } 

        $orderDeletedRow = $listening->order;
        $delete_success = $listening->delete();

        // sorting order
        if( $delete_success ){
            $table = Listening::orderBy('order', 'asc')->get();
            $this->reorderAfterRemoval($table,$orderDeletedRow);
        }

        return redirect()->route('listening.index')->with('success','listening audio deleted successfully');
    }

    public function active(Listening $listening){

        if($listening->status == '1'){
            $listening->status = '0';
        }else{
            $listening->status = '1';
        }
            $listening->save();

        return redirect()->route('listening.index');
    }
}
