<?php

namespace App\Http\Controllers\Exercises;

use App\Http\Controllers\Controller;

use App\Http\Requests\QuestionImageRequest;
use App\Models\Language;
use App\Models\Lesson;
use App\Models\List_exercise;
use App\Models\QuestionImage;
use Illuminate\Http\Request;
use Storage;

class QuestionsImageController extends Controller
{
    public function index(Request $request){
        $questionImages = QuestionImage::orderBy('order');
        $data = $this->selectOPtionOrderExercise($request,$questionImages,'questionImages');

        return view("pages.allExercises.question_image.index", $data);
    }

    public function create() {
        $locales = Language::where("status",1)->orderBy('order')->get();

        return view("pages.allExercises.question_image.create", compact("locales"));
    }

    public function store(QuestionImageRequest  $request) {
        $data = $request->all();
        if ($request->hasFile('audio')) {
            $random = hexdec(uniqid());
            $filename = $random . '.' . $request->audio->extension();
            Storage::disk('question_image')->putFileAs('', $request->audio,$filename);
            $data['audio'] = $filename;
        }
        if ($request->hasFile('image')) {         
            $image = $request->image;
            $imageName = $this->uploadFile($image,'question_image/image',true);
            $data['image'] = $imageName;
        }

        QuestionImage::create($data);

        return redirect()->route('questionImage.index')->with('success','question with image successfully created!');
    }

    public function edit(QuestionImage $questionImage){
        $lessons = Lesson::where('chapter_id', $questionImage->chapter_id)->orderBy('order')->get();
        $exercises = List_exercise::where('lesson_id', $questionImage->lesson_id)->orderBy('order')->get();

        return view("pages.allExercises.question_image.edit")->with("questionImage",$questionImage)->with("lessons",$lessons)->with("exercises", $exercises);
    }

    public function update(QuestionImageRequest $request, QuestionImage $questionImage){
        $questionImages = QuestionImage::all();
        $this->sortItems($questionImages, $questionImage->order, $request->order);

        $data = $request->all();
        if ($request->hasFile('audio')) {
            if ($questionImage->audio) {
                $this->removeFile($questionImage->audio, 'question_image/audio');
            } 
            $random = hexdec(uniqid());
            $filename = $random . '.' . $request->audio->extension();
            Storage::disk('question_image')->putFileAs('', $request->audio,$filename);
            $data['audio'] = $filename;
        }
        if ($request->hasFile('image')) { 
            if ($questionImage->image) {
                $this->removeFile($questionImage->image, 'question_image/image');
            }         
            $image = $request->image;
            $imageName = $this->uploadFile($image,'question_image/image',true);
            $data['image'] = $imageName;
        }

        $questionImage->update($data);
        return redirect()->route('questionImage.index')->with('success','question with image successfully updated!');
    }

    public function destroy(QuestionImage $questionImage){
        if ($questionImage->audio) {
            $this->removeFile($questionImage->audio, 'question_image/audio');
        } 
        if ($questionImage->image) {
            $this->removeFile($questionImage->image, 'question_image/image');
        } 
        $orderDeletedRow = $questionImage->order;
        $delete_success = $questionImage->delete();
        // sorting order
        if( $delete_success ){
            $table = QuestionImage::orderBy('order', 'asc')->get();
            $this->reorderAfterRemoval($table,$orderDeletedRow);
        }

        return redirect()->route('questionImage.index')->with('success','question with image deleted successfully');
    }

    public function active(QuestionImage $questionImage){

        if($questionImage->status == '1'){
            $questionImage->status = '0';
        }else{
            $questionImage->status = '1';
        }
            $questionImage->save();

        return redirect()->route('questionImage.index');
    }
}
