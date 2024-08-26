<?php

namespace App\Livewire;

use App\Models\Chapter;
use App\Models\Language;
use App\Models\Lesson;
use Livewire\Component;

class ListExerciseComponent extends Component
{
    public $chapters = null;
    public $lessons = null;
    public $locales = null;

    public $selectedOption;

    

    public function render()
    {
        $this->chapters = Chapter::orderBy('order')->get(); 
        $this->locales = Language::where("status",1)->orderBy('order')->get("locale");

        return view('livewire.list-exercise-component');
    }

    public function handleOptionChange()
    {
        $this->lessons = Lesson::where('chapter_id',$this->selectedOption)->orderBy('order')->get(); 
        // if ($this->lessons->isEmpty()) {
        //     dd('empty');
        // } else {
        //     dd('not empty');
        // }
        
        
    }
}
