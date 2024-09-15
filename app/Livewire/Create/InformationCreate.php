<?php

namespace App\Livewire\Create;

use App\Models\Information;
use App\Models\Language;
use App\Models\Lesson;
use App\Models\List_exercise;
use Livewire\Component;

class InformationCreate extends Component
{
    public $lesson_ids = [],$exercise_ids = [];
    public $exercises;

    public $queryExercise, $queryLesson; 



    public function mount(){
        if(session()->hasOldInput('exercise_ids')){
            foreach(old('exercise_ids') as $key => $value){
                $this->exercise_ids[$key] = $value;
            }
        }
            

        if(session()->hasOldInput('lesson_ids')){
            foreach(old('lesson_ids') as $key => $value){
                $this->lesson_ids[$key] = $value;
            }
            $this->exercises = List_exercise::whereIn('lesson_id',$this->lesson_ids)->with('lesson')->orderBy('order')->get();
        }
            
        // $lesson_ids[]=old('lesson_ids');

    }
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
