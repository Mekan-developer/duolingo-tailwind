<?php

namespace App\Http\Controllers\Exercises;

use App\Http\Controllers\Controller;
use App\Http\Requests\AudioTranslationRequest;
use App\Models\AudioTranslation;
use App\Models\Language;
use Illuminate\Http\Request;
use Storage;

class AudioTranslationController extends Controller
{
    public function index(Request $request){
        $audioTranslations = AudioTranslation::with('Exercise')->orderBy('order');
        $data = $this->selectOPtionOrderExercise($request,$audioTranslations,'audioTranslations');

        return view("pages.allExercises.audio_translation.index",$data);
    }

    public function create() {
        $locales = Language::where("status",1)->orderBy('order')->get();
        return view("pages.allExercises.audio_translation.create", compact("locales"));
    }

    public function store(AudioTranslationRequest $request) {
        // $data = [
        //     'chapter_id' => $request->chapter_id,
        //     'lesson_id' => $request->lesson_id,
        //     'exercise_id' => $request->exercise_id,
        //     'en_text' => $request->en_text,
        //     'translations_word' => $request->translations_word
        // ];

        $data = $request->all();
        if ($request->hasFile('audio')) {
            $random = hexdec(uniqid());
            $filename = $random . '.' . $request->audio->extension();
            Storage::disk('audio_translation_audio')->putFileAs('', $request->audio,$filename);
            
            $data['audio'] = $filename;
        }
        AudioTranslation::create($data);
        return redirect()->route('audioTranslation.index')->with('success','audio translation successfully created!');
    }

    public function destroy(AudioTranslation $audioTranslation){
        if ($audioTranslation->audio) {
            $this->removeFile($audioTranslation->audio, 'audio_translation_audio');
        } 

        $orderDeletedRow = $audioTranslation->order;
        $delete_success = $audioTranslation->delete();

        // sorting order
        if( $delete_success ){
            $table = AudioTranslation::orderBy('order', 'asc')->get();
            $this->reorderAfterRemoval($table,$orderDeletedRow);
        }

        return redirect()->route('audioTranslation.index')->with('success','audio translation with audio deleted successfully');
    }

    public function active(AudioTranslation $audioTranslation){

        if($audioTranslation->status == '1'){
            $audioTranslation->status = '0';
        }else{
            $audioTranslation->status = '1';
        }
            $audioTranslation->save();

        return redirect()->route('audioTranslation.index');
    }

}
