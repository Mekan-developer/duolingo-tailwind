<?php

namespace App\Http\Controllers\Exercises;

use App\Http\Controllers\Controller;
use App\Http\Requests\TestImageRequest;
use App\Models\Language;
use App\Models\Lesson;
use App\Models\List_exercise;
use App\Models\TestImage;
use Illuminate\Http\Request;
use Storage;

class TestImageController extends Controller
{
    public function index(Request $request) {;
        $testImages = TestImage::orderBy('order');
        $data = $this->selectOPtionOrderExercise($request,$testImages,'testImages');

        return view("pages.allExercises.test_image.index", $data);
    }


    public function create() {
        return view("pages.allExercises.test_image.create");
    }

    public function store(TestImageRequest $request) {
        $data = $request->all();
        if ($request->hasFile('correct_image')) {         
            $image = $request->correct_image;
            $imageName = $this->uploadFile($image,'test_audio_image/image',true);
            $data['correct_image'] = $imageName;
        }
        if ($request->hasFile('incorrect_image')) {         
            $image = $request->incorrect_image;
            $imageName = $this->uploadFile($image,'test_audio_image/image',true);
            $data['incorrect_image'] = $imageName;
        }

        if ($request->hasFile('audio')) {
            $random = hexdec(uniqid());
            $filename = $random . '.' . $request->audio->extension();
            Storage::disk('test_audio_image')->putFileAs('', $request->audio,$filename);
            $data['audio'] = $filename;
        }

        TestImage::create($data);
        return redirect()->route('testImage.index')->with('success','test image with audio created successfully!');
    
    }

    public function edit(TestImage $testImage){
        $lessons = Lesson::where('chapter_id', $testImage->chapter_id)->whereHas('listExercise')->orderBy('order')->get();
        $exercises = List_exercise::where('lesson_id', $testImage->lesson_id)->orderBy('order')->get();
        return view("pages.allExercises.test_image.edit")->with("testImage",$testImage)->with("lessons",$lessons)->with("exercises", $exercises);
    }

    public function update(TestImageRequest $request, TestImage $testImage) {
        $testImages = TestImage::all();
        $this->sortItems($testImages, $testImage->order, $request->order);

        $data = $request->all();
        if ($request->hasFile('correct_image')) {  
            if ($testImage->correct_image) {
                $this->removeFile($testImage->correct_image, 'test_audio_image/image');
            }        
            $image = $request->correct_image;
            $imageName = $this->uploadFile($image,'test_audio_image/image',true);
            $data['correct_image'] = $imageName;
        }

        if ($request->hasFile('incorrect_image')) {  
            if ($testImage->incorrect_image) {
                $this->removeFile($testImage->incorrect_image, 'test_audio_image/image');
            }        
            $image = $request->incorrect_image;
            $imageName = $this->uploadFile($image,'test_audio_image/image',true);
            $data['incorrect_image'] = $imageName;
        }

        if ($request->hasFile('audio')) {
            if ($testImage->audio) {
                $this->removeFile($testImage->audio, 'test_audio_image/audio');
            } 
            $random = hexdec(uniqid());
            $filename = $random . '.' . $request->audio->extension();
            Storage::disk('test_audio_image')->putFileAs('', $request->audio,$filename);
            $data['audio'] = $filename;
        }

        $testImage->update($data);
        return redirect()->route('testImage.index')->with('success','test image with audio updated successfully!');
    }

    public function destroy(TestImage $testImage){
        if ($testImage->audio) {
            $this->removeFile($testImage->audio, 'test_audio_image/audio');
        } 
        if ($testImage->correct_image) {
            $this->removeFile($testImage->correct_image, 'test_audio_image/image');
        }
        if ($testImage->incorrect_image) {
            $this->removeFile($testImage->incorrect_image, 'test_audio_image/image');
        } 
        $orderDeletedRow = $testImage->order;
        $delete_success = $testImage->delete();

        // sorting order
        if( $delete_success ){
            $table = TestImage::orderBy('order', 'asc')->get();
            $this->reorderAfterRemoval($table,$orderDeletedRow);
        }

        return redirect()->route('testImage.index')->with('success','test image with audio deleted successfully!');
    }
    public function active(TestImage $testImage){

        if($testImage->status == '1'){
            $testImage->status = '0';
        }else{
            $testImage->status = '1';
        }
            $testImage->save();

        return redirect()->route('testImage.index');
    }
}
