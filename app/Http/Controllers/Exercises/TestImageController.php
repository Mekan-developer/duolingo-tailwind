<?php

namespace App\Http\Controllers\Exercises;

use App\Http\Controllers\Controller;
use App\Http\Requests\TestImageRequest;
use App\Models\Language;
use App\Models\TestImage;
use Illuminate\Http\Request;
use Storage;

class TestImageController extends Controller
{
    public function index() {
        $locales = Language::where("status",1)->orderBy('order')->get();
        $testImages = TestImage::with('Exercise')->orderBy('order')->get();


        return view("pages.allExercises.test_image.index", compact("testImages","locales"));
    }


    public function create() {

        return view("pages.allExercises.test_image.create");
    }

    public function store(TestImageRequest $request) {
        $data = [
            'chapter_id' => $request->chapter_id,
            'lesson_id' => $request->lesson_id,
            'exercise_id' => $request->exercise_id,
        ];

        if ($request->hasFile('image')) {         
            $image = $request->image;
            $imageName = $this->uploadFile($image,'test_audio_image/image',true);
            $data['image'] = $imageName;
        }

        if ($request->hasFile('audio')) {
            $random = hexdec(uniqid());
            $filename = $random . '.' . $request->audio->extension();
            Storage::disk('test_audio_image')->putFileAs('', $request->audio,$filename);
            $data['audio'] = $filename;
        }

 
        TestImage::create($data);
        return redirect()->route('testImage.index')->with('success','vocabulary created successfully!');
    
    }

    public function destroy(TestImage $testImage){
        if ($testImage->audio) {
            $this->removeFile($testImage->audio, 'test_audio_image/audio');
        } 
        if ($testImage->image) {
            $this->removeFile($testImage->image, 'test_audio_image/image');
        } 
        $orderDeletedRow = $testImage->order;
        $delete_success = $testImage->delete();

        // sorting order
        if( $delete_success ){
            $table = TestImage::orderBy('order', 'asc')->get();
            $this->reorderAfterRemoval($table,$orderDeletedRow);
        }

        return redirect()->route('testImage.index')->with('success','test image deleted successfully');
     }
}
