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
            $lessons = Lesson::where('chapter_id',$request->sort_by)->orderBy("order")->with('chapter')->paginate(10);
        }else{
            $lessons = Lesson::orderBy("order")->with('chapter')->paginate(10);
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
        
        if ($request->hasFile('dopamine_image1')) {         
            $image = $request->dopamine_image1;
            $imageName = $this->uploadFile($image,'dopamine_images',true);
            $data['dopamine_image1'] = $imageName;
        }
        if ($request->hasFile('dopamine_image2')) {            
            $image = $request->dopamine_image2;
            $imageName = $this->uploadFile($image,'dopamine_images',true);
            $data['dopamine_image2'] = $imageName;
        }
        if ($request->hasFile('dopamine_image3')) {            
            $image = $request->dopamine_image3;
            $imageName = $this->uploadFile($image,'dopamine_images',true);
            $data['dopamine_image3'] = $imageName;
        }
        if ($request->hasFile('dopamine_image4')) {            
            $image = $request->dopamine_image4;
            $imageName = $this->uploadFile($image,'dopamine_images',true);
            $data['dopamine_image4'] = $imageName;
        }

        Lesson::create($data);  
        return redirect()->route('lessons')->with('success','Lesson created successfully!');
    }

    public function edit(Lesson $lesson){
        $chapters = Chapter::orderBy('order')->get(); 
        $lessons = Lesson::orderBy("order")->get();
        $locales = Language::where("status",1)->orderBy('order')->get();

        return view('pages.lessons.edit', compact('locales','chapters','lesson','lessons'));
    }

    public function update(LessonRequest $request, Lesson $lesson){ 

        
        $data = [
            'chapter_id' => $request->chapter_id,
            'title' => $request->title,
            'order' => $request->order
        ];
        if ($request->hasFile('dopamine_image1')) { 
            if ($lesson->dopamine_image1) {
                $this->removeFile($lesson->dopamine_image1, 'dopamine_images');
            }        
            $image = $request->dopamine_image1;
            $imageName = $this->uploadFile($image,'dopamine_images',true);
            $data['dopamine_image1'] = $imageName;
        }
        if ($request->hasFile('dopamine_image2')) { 
            if ($lesson->dopamine_image2) {
                $this->removeFile($lesson->dopamine_image2, 'dopamine_images');
            }       
            $image = $request->dopamine_image2;
            $imageName = $this->uploadFile($image,'dopamine_images',true);
            $data['dopamine_image2'] = $imageName;
        }
        if ($request->hasFile('dopamine_image3')) {  
            if ($lesson->dopamine_image3) {
                $this->removeFile($lesson->dopamine_image3, 'dopamine_images');
            }           
            $image = $request->dopamine_image3;
            $imageName = $this->uploadFile($image,'dopamine_images',true);
            $data['dopamine_image3'] = $imageName;
        }
        if ($request->hasFile('dopamine_image4')) {   
            if ($lesson->dopamine_image4) {
                $this->removeFile($lesson->dopamine_image4, 'dopamine_images');
            }          
            $image = $request->dopamine_image4;
            $imageName = $this->uploadFile($image,'dopamine_images',true);
            $data['dopamine_image4'] = $imageName;
        }

        $lessons = Lesson::all();
        $this->sortItems($lessons, $lesson->order, $request->order);

        $lesson->update($data);
        return redirect()->route('lessons')->with('success','Lesson updated successfully!');
    }


    public function destroy(Lesson $lesson){
        if ($lesson->dopamine_image1) {
            $this->removeFile($lesson->dopamine_image1, 'dopamine_images');
        } 
        if ($lesson->dopamine_image2) {
            $this->removeFile($lesson->dopamine_image2, 'dopamine_images');
        } 
        if ($lesson->dopamine_image3) {
            $this->removeFile($lesson->dopamine_image3, 'dopamine_images');
        } 
        if ($lesson->dopamine_image4) {
            $this->removeFile($lesson->dopamine_image4, 'dopamine_images');
        } 
        $orderDeletedRow = $lesson->order;
        $delete_success = $lesson->delete();

        // sorting order
        if( $delete_success ){
            $table = Chapter::orderBy('order', 'asc')->get();
            $this->reorderAfterRemoval($table,$orderDeletedRow);
        }
        // end sorting order

        return redirect()->route('lessons')->with('success','Lesson deleted successfully!');
    }
}
