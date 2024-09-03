<?php

namespace App\Http\Controllers\Exercises;

use App\Http\Controllers\Controller;
use App\Http\Requests\VideoRequest;
use App\Models\Chapter;
use App\Models\Language;
use App\Models\Lesson;
use App\Models\List_exercise;
use App\Models\Video;
use Illuminate\Http\Request;
use Storage;

class VideoController extends Controller
{
    
    public function index(Request $request){
        $videos = Video::orderBy('order');
        $data = $this->selectOPtionOrderExercise($request,$videos,'videos');
        return view("pages.allExercises.video.index",$data);
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

    public function active(Video $video){

        if($video->status == '1'){
            $video->status = '0';
        }else{
            $video->status = '1';
        }
            $video->save();

        return redirect()->route('video.index');
    }
}
