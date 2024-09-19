<?php

namespace App\Livewire\Edit;

use App\Models\Chapter;
use App\Models\Exercise;
use App\Models\Language;
use App\Models\Lesson;
use App\Models\List_exercise;
use Livewire\Component;

class InformationEdit extends Component
{

    public $exercise_ids = [],$lesson_ids = [];
    public $queryExercise, $queryLesson, $exercise_grammar_part; 

    public $info, $exercises;
    public function mount($information){
        $this->info = $information;
        $this->lesson_ids =json_decode($information->lessons);
        $this->exercise_ids =json_decode($information->exercises);
        $this->exercise_grammar_part = $information->part;

        $this->exercises = Exercise::All();
        
        
    }
    public function render()
    {
        $information = $this->info;
        if(isset($this->queryLesson)){
            $lessons = Lesson::where('name', 'like', '%' . $this->queryLesson . '%')->orderBy('order')->get();
       }else{
            $lessons = Lesson::orderBy('order')->get();
       }

        $locales = Language::where("status",1)->orderBy('order')->get();
        return view('livewire.edit.information-edit',[
            "locales" => $locales,
            'information'=> $information,
            'lessons' => $lessons,
            'exercises' => $this->exercises,
        ]);
    }

    public function updated(){
        if(!empty($this->lesson_ids)){
            if(isset($this->queryExercise)){
                $this->exercises = Exercise::where('name', 'like', '%' . $this->queryExercise . '%')->orderBy('order')->get();
           }else{
                $this->exercises = Exercise::orderBy('order')->get();
           }
        }else{
            $this->exercises = [];
        }
    }
}
