<?php

namespace App\Http\Controllers\Exercises;

use App\Http\Controllers\Controller;
use App\Http\Requests\PhoneticsRequest;
use App\Models\Language;
use App\Models\Lesson;
use App\Models\List_exercise;
use App\Models\Phonetics;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Storage;

class PhoneticsController extends Controller
{
    public function index(Request $request){
        $phonetics = Phonetics::orderBy('order');
        $data = $this->selectOPtionOrderExercise($request,$phonetics,'phonetics');

        $maxLength = DB::table('phonetics')->selectRaw('MAX(JSON_LENGTH(examples)) as max_length')->value('max_length');
        return view("pages.allExercises.phonetics.index",$data ,compact("maxLength"));
    }

    public function create(){
        $locales = Language::where("status",1)->orderBy('order')->get();

        return view("pages.allExercises.phonetics.create",compact("locales"));
    }

    public function store(PhoneticsRequest $request){
        $sounds = $request->files->get('sounds');
        $data = $request->all();
        foreach ($sounds as $key => $value) {
            if ($value instanceof \Symfony\Component\HttpFoundation\File\UploadedFile) {
                $random = hexdec(uniqid());
                $filename = $random . '.' . $value->getClientOriginalExtension();
                Storage::disk('phonetics')->putFileAs('', $value, $filename);
                $data['sounds'][$key] = $filename;
            }
        }

        if ($request->hasFile('audio')) {
            $random = hexdec(uniqid());
            $filename = $random . '.' . $request->audio->extension();
            Storage::disk('phonetics')->putFileAs('', $request->audio,$filename);
            $data['audio'] = $filename;
        }

        Phonetics::create($data);
        return redirect()->route('phonetics.index')->with('success','Phonetics created successfully');   
    }

    public function edit(Phonetics $phonetics){
        $lessons = Lesson::where('chapter_id', $phonetics->chapter_id)->orderBy('order')->get();
        $exercises = List_exercise::where('lesson_id', $phonetics->lesson_id)->orderBy('order')->get();
        
        return view("pages.allExercises.phonetics.edit")->with("phonetics",$phonetics)->with("lessons",$lessons)->with("exercises", $exercises);
    }

    public function update(PhoneticsRequest $request,Phonetics $phonetics){
        dd('test3');

        $sounds = $request->files->get('sounds');
        $data = $request->all();
        foreach ($sounds as $key => $value) {
            if ($value instanceof \Symfony\Component\HttpFoundation\File\UploadedFile) {
                $random = hexdec(uniqid());
                $filename = $random . '.' . $value->getClientOriginalExtension();
                Storage::disk('phonetics')->putFileAs('', $value, $filename);
                $data['sounds'][$key] = $filename;
            }
        }

        if ($request->hasFile('audio')) {
            $random = hexdec(uniqid());
            $filename = $random . '.' . $request->audio->extension();
            Storage::disk('phonetics')->putFileAs('', $request->audio,$filename);
            $data['audio'] = $filename;
        }

        Phonetics::create($data);
        return redirect()->route('phonetics.index')->with('success','Phonetics created successfully');   

    }

    public function destroy(Phonetics $phonetics){
        $data = $phonetics->attributesToArray();
        for ($i = 1; $i <= count($data['sounds']); $i++){
            $this->removeFile($data['sounds'][$i], 'phonetics');
        }   
        
        if ($phonetics->audio) {
            $this->removeFile($phonetics->audio, 'phonetics');
        } 

        $orderDeletedRow = $phonetics->order;
        $delete_success = $phonetics->delete();

        // sorting order
        if( $delete_success ){
            $table = Phonetics::orderBy('order', 'asc')->get();
            $this->reorderAfterRemoval($table,$orderDeletedRow);
        }

        return redirect()->route('phonetics.index')->with('success','Phonetics deleted successfully');
    }


    public function active(Phonetics $phonetics){

        if($phonetics->status == '1'){
            $phonetics->status = '0';
        }else{
            $phonetics->status = '1';
        }
        $phonetics->save();
        return redirect()->route('phonetics.index');
    }
}
