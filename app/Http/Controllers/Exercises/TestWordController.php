<?php

namespace App\Http\Controllers\Exercises;

use App\Http\Controllers\Controller;
use App\Http\Requests\TestWordRequest;
use App\Models\Language;
use App\Models\TestWord;
use Illuminate\Http\Request;
use Storage;

class TestWordController extends Controller
{
    public function index(Request $request) {

        $testWords = TestWord::orderBy('order')->get();

        $data = $this->selectOPtionOrderExercise($request,$testWords,'testWords');
        return view("pages.allExercises.test_word.index", $data);
    }

    public function create() {
        $locales = Language::where("status",1)->orderBy('order')->get();

        return view("pages.allExercises.test_word.create", compact("locales"));
    }

    public function store(TestWordRequest $request) {
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
            Storage::disk('test_word_audio')->putFileAs('', $request->audio,$filename);
            $data['audio'] = $filename;
        }

 
        TestWord::create($data);
        return redirect()->route('testWord.index')->with('success','test word with audio created successfully!');
    }

    public function destroy(TestWord $testWord){
        if ($testWord->audio) {
            $this->removeFile($testWord->audio, 'test_word_audio');
        } 
        $orderDeletedRow = $testWord->order;
        $delete_success = $testWord->delete();

        // sorting order
        if( $delete_success ){
            $table = TestWord::orderBy('order', 'asc')->get();
            $this->reorderAfterRemoval($table,$orderDeletedRow);
        }

        return redirect()->route('testWord.index')->with('success','test word with audio deleted successfully');
     }
}
