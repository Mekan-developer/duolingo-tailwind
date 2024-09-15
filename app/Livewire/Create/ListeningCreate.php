<?php

namespace App\Livewire\Create;

use App\Models\Chapter;
use App\Models\Language;
use App\Models\Lesson;
use App\Models\List_exercise;
use Livewire\Component;

class ListeningCreate extends Component
{
    public $locales, $chapters, $lessons=null,$exercises = null;
    public $selectedChapter, $selectedLesson;
    public $selectOptionLesson = null;


    // public function mount()
    // {
    //     dump(session()->hasOldInput('lesson_id'));
    //     // Проверка наличия старого значения 'lesson_id' и его восстановление
    //     if (session()->hasOldInput('lesson_id') && session('lesson_id') > 0) {
    //         $this->selectOptionLesson = session('lesson_id');
    //     }

    //     // Если нужно сбросить другое поле, например 'lesson'
    //     // if (session()->hasOldInput('lesson_id')) {
    //     //     $this->reset('lesson_id');
    //     // }
    // }
    public function render()
    {
        $this->chapters = Chapter::whereHas('lessonOption')->orderBy('order')->get();
        $this->locales = Language::where("status",1)->orderBy('order')->get();

        return view('livewire.create.listening-create');
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
