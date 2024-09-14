<?php

namespace App\Http\Controllers\Exercises;

use App\Http\Controllers\Controller;
use App\Http\Requests\AudioTranslationRequest;
use App\Models\AudioTranslation;
use App\Models\Language;
use App\Models\Lesson;
use App\Models\List_exercise;
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

    public function edit(AudioTranslation $audioTranslation){
        $lessons = Lesson::where('chapter_id', $audioTranslation->chapter_id)->whereHas('listExercise')->orderBy('order')->get();
        $exercises = List_exercise::where('lesson_id', $audioTranslation->lesson_id)->orderBy('order')->get();
        return view("pages.allExercises.audio_translation.edit")->with("audioTranslation",$audioTranslation)->with("lessons",$lessons)->with("exercises", $exercises);
    }

    public function update(AudioTranslationRequest $request,AudioTranslation $audioTranslation){
        $audioTranslations = AudioTranslation::all();
        $this->sortItems($audioTranslations, $audioTranslation->order, $request->order);

        $data = $request->all();
        if ($request->hasFile('audio')) {
            if ($audioTranslation->audio) {
                $this->removeFile($audioTranslation->audio, 'audio_translation_audio');
            }
            $random = hexdec(uniqid());
            $filename = $random . '.' . $request->audio->extension();
            Storage::disk('audio_translation_audio')->putFileAs('', $request->audio,$filename);
            $data['audio'] = $filename;
        }
        $audioTranslation->update($data);
        return redirect()->route('audioTranslation.index')->with('success','audio translation successfully updated!');
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
