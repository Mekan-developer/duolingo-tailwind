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

        $data = $request->all();
        if ($request->hasFile('video')) {
            $random = hexdec(uniqid());
            $filename = $random . '.' . $request->video->extension();
            Storage::disk('video')->putFileAs('', $request->video,$filename);
            $data['video'] = $filename;
        }
        Video::create($data);

        return redirect()->route('video.index')->with('success','video created successfully!');    
    }

    public function edit(Video $video){ 
        $lessons = Lesson::where('chapter_id', $video->chapter_id)->orderBy('order')->get();
        $exercises = List_exercise::where('lesson_id', $video->lesson_id)->orderBy('order')->get();
        return view("pages.allExercises.video.edit")->with("video",$video)->with("lessons",$lessons)->with("exercises", $exercises);
     }

     public function update(VideoRequest $request, Video $video){   
        $videos = Video::all();
        $this->sortItems($videos, $video->order, $request->order);

        $data = $request->all();
        if ($request->hasFile('video')) {
            if ($video->video) 
                $this->removeFile($video->video, 'video');
            $random = hexdec(uniqid());
            $filename = $random . '.' . $request->video->extension();
            Storage::disk('video')->putFileAs('', $request->video,$filename);
            $data['video'] = $filename;
        }

        $video->update($data);

        return redirect()->route('video.index')->with('success','video updated successfully!');
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
