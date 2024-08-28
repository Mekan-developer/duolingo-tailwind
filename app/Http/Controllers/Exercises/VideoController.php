<?php

namespace App\Http\Controllers\Exercises;

use App\Http\Controllers\Controller;
use App\Http\Requests\VideoRequest;
use App\Models\Language;
use App\Models\Video;
use Illuminate\Http\Request;
use Storage;

class VideoController extends Controller
{
    
    public function index(){
        $locales = Language::where('status',1)->orderBy('order')->get();
        $videos = Video::orderBy('order')->get();
       
        return view("pages.allExercises.video.index", compact("videos","locales"));
    }

    public function create(){
        return view("pages.allExercises.video.create");
    }

    public function store(VideoRequest $request){
        $data = [
            'chapter_id' => $request->chapter_id,
            'lesson_id' => $request->lesson_id,
            'exercise_id' => $request->exercise_id,
        ];
        if ($request->hasFile('video')) {
            $random = hexdec(uniqid());
            $filename = $random . '.' . $request->video->extension();
            Storage::disk('video')->putFileAs('', $request->video,$filename);
            $data['video'] = $filename;
        }
        $message = 'Images created sccessfully!';
        Video::create($data);

        return redirect()->route('video.index')->with('success',$message);    
    }

    public function edit(Video $video){ 
        dd($video);
     }

     public function update(VideoRequest $request, Video $video){   

     }

     public function destroy(Video $video){
        if ($video->video) {
            $this->removeFile($video->video, 'video');
        } 
        $orderDeletedRow = $video->order;
        $delete_success = $video->delete();

        // sorting order
        if( $delete_success ){
            $table = Video::orderBy('order', 'asc')->get();
            $this->reorderAfterRemoval($table,$orderDeletedRow);
        }

        return redirect()->route('video.index')->with('success','video deleted successfully');
     }
}
