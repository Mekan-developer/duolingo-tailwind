<?php

namespace App\Livewire;

use App\Models\Chapter;
use App\Models\Language;
use App\Models\Lesson;
use App\Models\List_exercise;
use Livewire\Component;

class TestImageCreate extends Component
{
    public $locales, $chapters, $lessons=null,$exercises = null;
    public $selectedChapter, $selectedLesson;
    public function render()
    {
        $this->chapters = Chapter::whereHas('lesson')->orderBy('order')->get();
        $this->locales = Language::where("status",1)->orderBy('order')->get();

        return view('livewire.test-image-create');
    }

    public function selectedChapterHandle()
    {
        $this->exercises = null;
        $this->lessons = Lesson::whereHas('listExercise')->where('chapter_id',$this->selectedChapter)->orderBy('order')->get(); 
    }

    public function selectedLessonHandle(){
        $this->exercises = List_exercise::where('lesson_id',$this->selectedLesson)->orderBy('order')->get(); 
    }
}
