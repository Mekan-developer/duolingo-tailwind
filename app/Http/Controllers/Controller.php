<?php

namespace App\Http\Controllers;
use App\Models\Chapter;
use App\Models\Language;
use App\Models\Lesson;
use App\Models\List_exercise;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

abstract class Controller
{
    
    
    protected function uploadFile($file,$path,$icon = false)
    {
        // create image manager with desired driver
        $manager = new ImageManager(new Driver());
        $random = hexdec(uniqid());
        // $filename = $random . '.' . $file->extension();
        $webpFilename = $random . '.webp';

        $img = $manager->read($file);

        if($icon){
            $web_image_width = 100;
        }else{
            $web_image_width = 420;
        }
        

        $height = $img->height();
        $width = $img->width();
        $scale = $height / $width;

        $web_image_height = $scale * $web_image_width;


        create_folder($path);

        $web_img = $img->resize($web_image_width, $web_image_height);
        $web_img->toWebp(90)->save(storage_path('app/public/uploads/'. $path .'/' . $webpFilename));
        return $webpFilename;
    }

    protected function removeFile($file, $path)
    {
        $filePath = 'public/uploads/'.$path .'/' . $file;
        if(Storage::exists($filePath)) {
            Storage::delete($filePath);
        }
    }

    public function sortItems($table,$fromOrder,$toOrder){
        if($fromOrder !== $toOrder){
            if($fromOrder > $toOrder){
                for($i = $fromOrder-1; $i >= $toOrder; $i--){
                    $poem_order_up = $table->where('order',$i)->first();
                    $poem_order_up->update([
                        'order' => $poem_order_up->order+1,
                    ]);
                }
            }else{
                for($i = $fromOrder+1; $i <= $toOrder; $i++){
                    $poem_order_up = $table->where('order',$i)->first();
                    $poem_order_up->update([
                        'order' => $poem_order_up->order - 1,
                    ]);
                }
            }
        }
    }

    public function reorderAfterRemoval($table,$orderDeletedRow)
    {
        $itemsToUpdate = $table->where('order', '>', $orderDeletedRow);
        foreach ($itemsToUpdate as $item) {
            $item->update(['order' => $item->order - 1]);
        }
    }


    //ordering exercises start
    public function selectOPtionOrderExercise($request, $exercises,$exerciseName){
        $locales = Language::where("status",1)->orderBy('order')->get();
          // for ordering
        $chapters = Chapter::orderBy('order')->get(); 
        $selected_chapter_id = null; $selected_lesson_id = null;
        if($request->has('sort_by_chapter') && $request->sort_by_chapter > 0 ){
            $lessons = Lesson::where('chapter_id',$request->sort_by_chapter)->orderBy("order")->with('chapter')->get();
            $exercises = $exercises->where('chapter_id',$request->sort_by_chapter);
        }else{
            $lessons = Lesson::orderBy("order")->get();
        }

        if($request->has('sort_by_lesson') && $request->sort_by_lesson > 0 ){
            $selected_lesson = $lessons->where('id',$request->sort_by_lesson)->first();
            $selected_chapter_id = $selected_lesson['chapter_id'];//for chapter staying selected
            
            $lessons = Lesson::where('chapter_id',$selected_chapter_id)->orderBy("order")->with('chapter')->get();
            $listExercises = List_exercise::where('lesson_id',$request->sort_by_lesson)->orderBy("order")->get();
            $exercises = $exercises->where('lesson_id',$request->sort_by_lesson);
        }else{
            $listExercises = List_exercise::orderBy("order")->get();
        }

        if($request->has('sort_by_exercise') && $request->sort_by_exercise > 0 ){
            $selected_exercise = $listExercises->where('id',$request->sort_by_exercise)->first();
            $selected_lesson_id = $selected_exercise['lesson_id'];//for chapter staying selected
            
            $selected_lesson = $lessons->where('id',$selected_lesson_id)->first();
            $selected_chapter_id = $selected_lesson['chapter_id'];
            $exercises = $exercises->where('exercise_id',$request->sort_by_exercise);
        }
        $exercises = $exercises->paginate(10);

        return [
                "locales" => $locales,
                $exerciseName => $exercises,
                "chapters" => $chapters,
                "lessons" => $lessons,
                "listExercises" => $listExercises,
                "selected_chapter_id" => $selected_chapter_id,
                "selected_lesson_id" => $selected_lesson_id
        ];
    }
    


}
