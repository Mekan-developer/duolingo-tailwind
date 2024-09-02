<?php

namespace App\Http\Controllers\Exercises;

use App\Http\Controllers\Controller;
use App\Http\Requests\PhoneticsRequest;
use App\Models\Language;
use App\Models\Phonetics;
use Illuminate\Http\Request;
use Storage;

class PhoneticsController extends Controller
{
    public function index(){
        $locales = Language::where("status",1)->orderBy('order')->get();
        $phonetics = Phonetics::all();


        return view("pages.allExercises.phonetics.index",compact("phonetics","locales"));
    }

    public function create(){
        $locales = Language::where("status",1)->orderBy('order')->get();

        return view("pages.allExercises.phonetics.create",compact("locales"));
    }

    public function store(PhoneticsRequest $request){

        
        $data = [
            'phonetic_alphabet' => $request->phonetic_alphabet,
            'phonetic_text' => $request->phonetic_text,
            'chapter_id' => $request->chapter_id,
            'lesson_id' => $request->lesson_id,
            'exercise_id' => $request->exercise_id,
        ];
        
        
        $file_names = ['example1' => 'sound1','example2' => 'sound2','example3' => 'sound3','example4' => 'sound4','example5' => 'sound5'];
        foreach ($file_names as $key => $file_name){
            if ($request->hasFile($file_name)) {
                $random = hexdec(uniqid());
                $filename = $random . '.' . $request->$file_name->extension();
                Storage::disk('phonetics')->putFileAs('', $request->$file_name,$filename);
                $data[$file_name] = $filename;
                $data[$key] = $request->$key;
            }
        }
       
        Phonetics::create($data);
        return redirect()->route('phonetics.index')->with('success','');      
        
    }

    public function destroy(Phonetics $phonetic){
        for ($i = 1; $i < 6; $i++){
            if ($phonetic->{'sound'.$i}) {
                $this->removeFile($phonetic->{'sound'.$i}, 'phonetics');
            } 
        }        

        $orderDeletedRow = $phonetic->order;
        $delete_success = $phonetic->delete();

        // sorting order
        if( $delete_success ){
            $table = Phonetics::orderBy('order', 'asc')->get();
            $this->reorderAfterRemoval($table,$orderDeletedRow);
        }

        return redirect()->route('phonetics.index')->with('success','listening audio deleted successfully');
    }
}
