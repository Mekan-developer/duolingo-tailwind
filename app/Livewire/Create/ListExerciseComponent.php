<?php

namespace App\Livewire\Create;

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
        $this->chapters = Chapter::whereHas('lessonOption')->orderBy('order')->get(); 
        $this->locales = Language::where("status",1)->orderBy('order')->get();

        return view('livewire.create.list-exercise-component');
    }

    public function handleOptionChange()
    {
        $this->lessons = Lesson::where('chapter_id',$this->selectedOption)->orderBy('order')->get(); 
    }
}
