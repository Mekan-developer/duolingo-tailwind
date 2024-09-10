<?php

namespace App\Livewire\Create;

use App\Models\Information;
use App\Models\Language;
use App\Models\Lesson;
use App\Models\List_exercise;
use Livewire\Component;

class InformationCreate extends Component
{
    public $exercise_ids = [],$lesson_ids = [];
    public $exercises;



    public function render()
    {
       
        $lessons = Lesson::orderBy('order')->get();
        

        $locales = Language::where("status",1)->orderBy('order')->get();
        return view('livewire.create.information-create',[
            "locales" => $locales,
            'lessons' => $lessons,
            'exercises' => $this->exercises ?? ''
        ]);
    }

    public function checkBoxToggle(){
        if(!empty($this->lesson_ids)){
            $this->exercises = List_exercise::whereIn('lesson_id',$this->lesson_ids)->with('lesson')->orderBy('order')->get();
        }else{
            $this->exercises = [];
        }
    }
   
    // public function create(){
    //     // $this->validate();

    //     dd($this->exercise_ids);
    //     Information::create([
    //         'exercises' => $this->exercise_ids,
    //         'lessons' => $this->lesson_ids,
    //         'information' => $this->information,
    //     ]);
    // }
}
