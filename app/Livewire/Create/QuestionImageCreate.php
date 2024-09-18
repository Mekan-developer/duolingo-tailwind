<?php

namespace App\Livewire\Create;

use App\Models\Chapter;
use App\Models\Language;
use App\Models\Lesson;
use App\Models\List_exercise;
use Livewire\Component;

class QuestionImageCreate extends Component
{
    public $locales, $chapters, $lessons=null;
    public $selectedChapter, $selectedLesson ;

    public function mount(){
        if (session()->hasOldInput('chapter_id') && old('chapter_id') > 0) {
            $this->selectedChapter = old('chapter_id');
            $this->selectedChapterHandle();
        }
        if (session()->hasOldInput('lesson_id') && old('lesson_id') > 0) {
            $this->selectedLesson = old('lesson_id');
        }
    }
    public function render()
    {
        $this->chapters = Chapter::whereHas('lesson')->orderBy('order')->get();
        $this->locales = Language::where("status",1)->orderBy('order')->get();

        return view('livewire.create.question-image-create');
    }

    public function selectedChapterHandle()
    {
        $this->lessons = Lesson::where('chapter_id',$this->selectedChapter)->orderBy('order')->get(); 
    }
}
