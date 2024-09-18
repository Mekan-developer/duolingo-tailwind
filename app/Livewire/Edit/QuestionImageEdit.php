<?php

namespace App\Livewire\Edit;

use App\Models\Chapter;
use App\Models\Exercise;
use App\Models\Language;
use App\Models\Lesson;
use App\Models\List_exercise;
use App\Models\QuestionImage;
use Livewire\Component;

class QuestionImageEdit extends Component
{
    public $questionImage,$lessons,$lesson_id;
    public $selectedChapter = null,$selectedLesson = null;
    public $switch_lesson = false;

    public function mount($questionImage,$lessons)
    {
        $this->questionImage = $questionImage;
        $this->selectedLesson = $questionImage->lesson_id;
        $this->selectedChapter = $questionImage->chapter_id;
        $this->lessons = $lessons;
    }
    public function render()
    {
        $chapters = Chapter::whereHas('lesson')->orderBy("order")->get();
        $locales = Language::orderBy("order")->get();

        $questionImages = QuestionImage::orderBy("order")->get();
        return view('livewire.edit.question-image-edit',[
            "questionImages" => $questionImages,
            "chapters" => $chapters,
            "lessons" => $this->lessons,
            "locales" => $locales
        ]);
    }

    public function selectedChapterHandle()
    {
        $this->selectedLesson = null;
        $this->switch_lesson = true;
        $this->lesson_id = null;
        $this->lessons = Lesson::where('chapter_id',$this->selectedChapter)->orderBy('order')->get();
    }
 
    public function selectedLessonHandle(){
        $this->switch_lesson = false;
        $this->exercises = Exercise::where('lesson_id',$this->selectedLesson)->orderBy('order')->get(); 
    }
}
