<?php

namespace App\Livewire\Edit;

use App\Models\Chapter;
use App\Models\Language;
use App\Models\Lesson;
use App\Models\List_exercise;
use App\Models\TestWord;
use Livewire\Component;

class TestWordEdit extends Component
{
    public $testWord,$lessons,$lesson_id;
    public $selectedChapter = null,$selectedLesson = null;
    public $switch_lesson = false;

    public function mount($testWord,$lessons)
    {
        $this->testWord = $testWord;
        $this->selectedLesson = $testWord->lesson_id;
        $this->selectedChapter = $testWord->chapter_id;
        $this->lessons = $lessons;

    }
    public function render()
    {
        $chapters = Chapter::whereHas('lesson')->orderBy("order")->get();
        $locales = Language::orderBy("order")->get();

        $testWords = TestWord::orderBy("order")->get();

        return view('livewire.edit.test-word-edit',[
            "testWords" => $testWords,
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
