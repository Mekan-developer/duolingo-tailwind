<?php

namespace App\Livewire\Create;

use App\Models\Chapter;
use App\Models\Language;
use App\Models\Lesson;
use App\Models\List_exercise;
use Livewire\Component;

class PhoneticsCreate extends Component
{
    public $countExamples = 1,$lessons=null,$exercises = null;
    public $selectedChapter, $selectedLesson;
    public function render()
    {
        $chapters = Chapter::whereHas('lessonOption')->orderBy('order')->get();
        $locales = Language::where("status",1)->orderBy('order')->get();

        return view('livewire.create.phonetics-create',[
            'chapters' => $chapters,
            'locales' => $locales,
        ]);
    }

    public function addExamples(){
        $this->countExamples++;
    }
    public function removeExamples(){
        $this->countExamples--;
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
