<?php

namespace App\Http\Controllers\Exercises;

use App\Http\Controllers\Controller;
use App\Http\Requests\TestWordRequest;
use App\Models\Language;
use App\Models\Lesson;
use App\Models\List_exercise;
use App\Models\TestWord;
use Illuminate\Http\Request;
use Storage;

class TestWordController extends Controller
{
    public function index(Request $request) {

        $testWords = TestWord::orderBy('order');

        $data = $this->selectOPtionOrderExercise($request,$testWords,'testWords');
        return view("pages.allExercises.test_word.index", $data);
    }

    public function create() {
        $locales = Language::where("status",1)->orderBy('order')->get();

        return view("pages.allExercises.test_word.create", compact("locales"));
    }

    public function store(TestWordRequest $request) {
        $data = $request->all();
        if ($request->hasFile('audio')) {
            $random = hexdec(uniqid());
            $filename = $random . '.' . $request->audio->extension();
            Storage::disk('test_word_audio')->putFileAs('', $request->audio,$filename);
            $data['audio'] = $filename;
        }

        TestWord::create($data);
        return redirect()->route('testWord.index')->with('success','test word with audio created successfully!');
    }

    public function edit(TestWord $testWord) {
        $lessons = Lesson::where('chapter_id', $testWord->chapter_id)->orderBy('order')->get();
        $exercises = List_exercise::where('lesson_id', $testWord->lesson_id)->orderBy('order')->get();
        return view("pages.allExercises.test_word.edit")->with("testWord",$testWord)->with("lessons",$lessons)->with("exercises", $exercises);
    }

    public function update(TestWordRequest $request,TestWord $testWord) {
        $testWords = TestWord::all();
        $this->sortItems($testWords, $testWord->order, $request->order);

        $data = $request->all();
        if ($request->hasFile('audio')) {
            if ($testWord->audio) {
                $this->removeFile($testWord->audio, 'test_word_audio');
            } 
            $random = hexdec(uniqid());
            $filename = $random . '.' . $request->audio->extension();
            Storage::disk('test_word_audio')->putFileAs('', $request->audio,$filename);
            $data['audio'] = $filename;
        }

        $testWord->update($data);
        return redirect()->route('testWord.index')->with('success','test word with audio updated successfully!');
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
     public function active(TestWord $testWord){

        if($testWord->status == '1'){
            $testWord->status = '0';
        }else{
            $testWord->status = '1';
        }
            $testWord->save();

        return redirect()->route('testWord.index');
    }
}
