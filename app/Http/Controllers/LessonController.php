<?php

namespace App\Http\Controllers;

use App\Http\Requests\LessonRequest;
use App\Models\Chapter;
use App\Models\Language;
use App\Models\Lesson;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    public function index(Request $request){
        $chapters = Chapter::orderBy('order')->get(); 

        $locales = Language::where("status",1)->get("locale");

        if($request->has('sort_by') && $request->sort_by > 0 ){
            $lessons = Lesson::where('chapter_id',$request->sort_by)->orderBy("order")->with('chapter')->get();
        }else{
            $lessons = Lesson::orderBy("order")->with('chapter')->get();
        }

        return view("pages.lessons.index", compact("locales","lessons","chapters"));
    }

    public function create(){ 
        $chapters = Chapter::orderBy('order')->get(); 
        $locales = Language::where("status",1)->orderBy('order')->get();

        return view("pages.lessons.create", compact("locales","chapters"));
    }

    public function store(LessonRequest $request){ 

        $data = [
            'title' => $request->title,
            'chapter_id' => $request->chapter_id,
        ];

        if ($request->hasFile('dopamine_image_1')) {         
            $image = $request->dopamine_image_1;
            $imageName = $this->uploadFile($image,'dopamine_images',true);
            $data['dopamine_image_1'] = $imageName;
        }
        if ($request->hasFile('dopamine_image_2')) {            
            $image = $request->dopamine_image_2;
            $imageName = $this->uploadFile($image,'dopamine_images',true);
            $data['dopamine_image_2'] = $imageName;
        }
        if ($request->hasFile('dopamine_image_3')) {            
            $image = $request->dopamine_image_3;
            $imageName = $this->uploadFile($image,'dopamine_images',true);
            $data['dopamine_image_3'] = $imageName;
        }
        if ($request->hasFile('dopamine_image_4')) {            
            $image = $request->dopamine_image_4;
            $imageName = $this->uploadFile($image,'dopamine_images',true);
            $data['dopamine_image_4'] = $imageName;
        }
        Lesson::create($data);  
        return redirect()->route('lessons');
    }

    public function edit(Lesson $lesson){
        $chapters = Chapter::orderBy('order')->get(); 
        $lessons = Lesson::orderBy("order")->get();
        $locales = Language::where("status",1)->orderBy('order')->get();

        return view('pages.lessons.edit', compact('locales','chapters','lesson','lessons'));
    }

    public function update(LessonRequest $request, Lesson $lesson){ 
        
        $lessons = Lesson::all();
        $this->sortItems($lessons, $lesson->order, $request->order);

        $lesson->update($request->all());
        return redirect()->route('lessons');
    }


    public function destroy(Lesson $lesson){
        if ($lesson->dopamine_image_1) {
            $this->removeFile($lesson->dopamine_image_1, 'dopamine_images');
        } 
        if ($lesson->dopamine_image_2) {
            $this->removeFile($lesson->dopamine_image_2, 'dopamine_images');
        } 
        if ($lesson->dopamine_image_3) {
            $this->removeFile($lesson->dopamine_image_3, 'dopamine_images');
        } 
        if ($lesson->dopamine_image_4) {
            $this->removeFile($lesson->dopamine_image_4, 'dopamine_images');
        } 
        $orderDeletedRow = $lesson->order;
        $delete_success = $lesson->delete();

        // sorting order
        if( $delete_success ){
            $table = Chapter::orderBy('order', 'asc')->get();
            $this->reorderAfterRemoval($table,$orderDeletedRow);
        }
        // end sorting order

        return redirect()->route('lessons');
    }
}
