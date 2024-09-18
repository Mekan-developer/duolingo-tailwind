<?php

namespace App\Livewire\Edit;

use App\Models\Chapter;
use App\Models\Language;
use App\Models\Lesson;
use App\Models\List_exercise;
use App\Models\QuestionWord;
use Livewire\Component;

class QuestionWordEdit extends Component
{
    public $questionWord,$lessons,$lesson_id;
    public $selectedChapter = null,$selectedLesson = null;
    public $switch_lesson = false;

    public function mount($questionWord,$lessons)
    {
        $this->questionWord = $questionWord;
        $this->selectedChapter = $questionWord->chapter_id;
        $this->selectedLesson = $questionWord->lesson_id;
        $this->lessons = $lessons;
    }
    public function render()
    {
        $chapters = Chapter::orderBy("order")->get();
        $locales = Language::orderBy("order")->get();
        $questionWords = QuestionWord::orderBy("order")->get();

        return view('livewire.edit.question-word-edit',[
            "questionWords" => $questionWords,
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
        $this->exercises = List_exercise::where('lesson_id',$this->selectedLesson)->orderBy('order')->get(); 
    }

}
