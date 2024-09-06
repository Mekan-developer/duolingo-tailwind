<?php

namespace App\Livewire\Edit;

use App\Models\Chapter;
use App\Models\Language;
use App\Models\Lesson;
use App\Models\List_exercise;
use Livewire\Component;

class ListExerciseEdit extends Component
{
    public $list_exercise,$lessons;
    public $selectedChapter;
    

    public function mount($list_exercise)
    {
        $this->list_exercise = $list_exercise;
        $this->selectedChapter = $list_exercise->chapter_id;
    }
    public function render()
    {
        $chapters = Chapter::whereHas('lesson')->orderBy('order')->get();  
        $locales = Language::where("status",1)->orderBy('order')->get();
        $list_exercises = List_exercise::orderBy('order')->get();


        return view('livewire.edit.list-exercise-edit',[
            "chapters" => $chapters,
            "lessons" => $this->lessons,
            "locales" => $locales,
            "list_exercises"=> $list_exercises
        ]);
    }

    public function selectedChapterHandle()
    {        
        $this->lessons = Lesson::where('chapter_id',$this->selectedChapter)->orderBy('order')->get(); 
    }
}
