<?php

namespace App\Http\Controllers\Exercises;

use App\Http\Controllers\Controller;
use App\Http\Requests\QuestionWordRequest;
use App\Models\Language;
use App\Models\QuestionWord;
use Illuminate\Http\Request;
use Storage;

class QuestionWordController extends Controller
{
    public function index(Request $request){
        $questionWords = QuestionWord::orderBy('order');
        $data = $this->selectOPtionOrderExercise($request,$questionWords,'questionWords');

        return view("pages.allExercises.question_word.index", $data);
    }

    public function create() {
        $locales = Language::where("status",1)->orderBy('order')->get();

        return view("pages.allExercises.question_word.create", compact("locales"));
    }

    public function store(QuestionWordRequest $request) {
        $data = [
            'chapter_id' => $request->chapter_id,
            'lesson_id' => $request->lesson_id,
            'exercise_id' => $request->exercise_id,
            'en_text' => $request->en_text,
            'translations_word' => $request->translations_word
        ];

        if ($request->hasFile('audio')) {
            $random = hexdec(uniqid());
            $filename = $random . '.' . $request->audio->extension();
            Storage::disk('question_word_audio')->putFileAs('', $request->audio,$filename);
            $data['audio'] = $filename;
        }

        QuestionWord::create($data);

        return redirect()->route('questionWord.index')->with('success','question words with audio successfully created!');
    }

    public function destroy(QuestionWord $questionWord){
        if ($questionWord->audio) {
            $this->removeFile($questionWord->audio, 'question_word_audio');
        } 

        $orderDeletedRow = $questionWord->order;
        $delete_success = $questionWord->delete();

        // sorting order
        if( $delete_success ){
            $table = QuestionWord::orderBy('order', 'asc')->get();
            $this->reorderAfterRemoval($table,$orderDeletedRow);
        }

        return redirect()->route('questionWord.index')->with('success','questionWords with audio deleted successfully');
    }

    public function active(QuestionWord $questionWord){

        if($questionWord->status == '1'){
            $questionWord->status = '0';
        }else{
            $questionWord->status = '1';
        }
            $questionWord->save();

        return redirect()->route('questionWord.index');
    }


}
