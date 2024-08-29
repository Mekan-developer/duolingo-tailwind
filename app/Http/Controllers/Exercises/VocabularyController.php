<?php

namespace App\Http\Controllers\Exercises;

use App\Http\Controllers\Controller;
use App\Http\Requests\VocabularyRequest;
use App\Models\Language;
use App\Models\Vocabulary;
use Illuminate\Http\Request;
use Storage;

class VocabularyController extends Controller
{
    public function index() {
        $locales = Language::where("status",1)->orderBy('order')->get();
        $vocabularies = Vocabulary::with('Exercise')->orderBy('order')->get();


        return view("pages.allExercises.vocabulary.index", compact("locales","vocabularies"));
    }


    public function create() {
        $locales = Language::where("status",1)->orderBy('order')->get();

        return view("pages.allExercises.vocabulary.create", compact("locales"));
    
    }

    public function store(VocabularyRequest $request) {

        $data = [
            'chapter_id' => $request->chapter_id,
            'lesson_id' => $request->lesson_id,
            'exercise_id' => $request->exercise_id,
            'en_text' => $request->en_text,
            'translations_word' => $request->translations_word
        ];


        if ($request->hasFile('image')) {         
            $image = $request->image;
            $imageName = $this->uploadFile($image,'vocabulary/image',true);
            $data['image'] = $imageName;
        }

        if ($request->hasFile('audio')) {
            $random = hexdec(uniqid());
            $filename = $random . '.' . $request->audio->extension();
            Storage::disk('vocabulary_audio')->putFileAs('', $request->audio,$filename);
            $data['audio'] = $filename;
        }

 
        Vocabulary::create($data);

        return redirect()->route('vocabulary.index')->with('success','vocabulary created successfully!');
    
    }

    public function destroy(Vocabulary $vocabulary){
        if ($vocabulary->audio) {
            $this->removeFile($vocabulary->audio, 'vocabulary/audio');
        } 
        if ($vocabulary->image) {
            $this->removeFile($vocabulary->image, 'vocabulary/image');
        } 
        $orderDeletedRow = $vocabulary->order;
        $delete_success = $vocabulary->delete();

        // sorting order
        if( $delete_success ){
            $table = Vocabulary::orderBy('order', 'asc')->get();
            $this->reorderAfterRemoval($table,$orderDeletedRow);
        }

        return redirect()->route('vocabulary.index')->with('success','vocabulary deleted successfully');
     }
}
