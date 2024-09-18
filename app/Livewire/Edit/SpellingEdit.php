<?php

namespace App\Livewire\Edit;

use App\Models\Chapter;
use App\Models\Language;
use App\Models\Lesson;
use App\Models\List_exercise;
use App\Models\Spelling;
use Livewire\Component;

class SpellingEdit extends Component
{
    public $spelling,$lessons,$lesson_id;
    public $selectedChapter = null,$selectedLesson = null;
    public $switch_lesson = false;

    public function mount($spelling,$lessons)
    {
        $this->spelling = $spelling;
        $this->selectedLesson = $spelling->lesson_id;
        $this->selectedChapter = $spelling->chapter_id;
        $this->lessons = $lessons;
    }
    public function render()
    {
        $chapters = Chapter::whereHas('lesson')->orderBy("order")->get();
        $locales = Language::orderBy("order")->get();

        $spellings = Spelling::orderBy("order")->get();

        return view('livewire.edit.spelling-edit',[
            "spellings" => $spellings,
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
}
