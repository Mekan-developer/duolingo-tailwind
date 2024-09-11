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

    public $queryExercise, $queryLesson; 



    public function render()
    {

       if(isset($this->queryLesson)){
            $lessons = Lesson::where('name', 'like', '%' . $this->queryLesson . '%')->orderBy('order')->get();
       }else{
            $lessons = Lesson::orderBy('order')->get();
       }
        
        $locales = Language::where("status",1)->orderBy('order')->get();
        return view('livewire.create.information-create',[
            "locales" => $locales,
            'lessons' => $lessons,
            'exercises' => $this->exercises ?? ''
        ]);
    }

    public function updated(){
        if(!empty($this->lesson_ids)){
            if(isset($this->queryExercise)){
                $this->exercises = List_exercise::whereIn('lesson_id',$this->lesson_ids)->where('name', 'like', '%' . $this->queryExercise . '%')->with('lesson')->orderBy('order')->get();
           }else{
                $this->exercises = List_exercise::whereIn('lesson_id',$this->lesson_ids)->with('lesson')->orderBy('order')->get();
           }
        }else{
            $this->exercises = [];
        }
    }
}
