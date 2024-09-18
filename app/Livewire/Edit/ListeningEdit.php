<?php

namespace App\Livewire\Edit;

use App\Models\Chapter;
use App\Models\Language;
use App\Models\Lesson;
use App\Models\Listening;
use Livewire\Component;

class ListeningEdit extends Component
{
    public $listening,$lessons,$lesson_id;
    public $selectedChapter = null,$selectedLesson = null;
    public $switch_lesson = false;

    public function mount($listening,$lessons)
    {
        $this->listening = $listening;
        $this->selectedLesson = $listening->lesson_id;
        $this->selectedChapter = $listening->chapter_id;
        $this->lessons = $lessons;
    }
    public function render()
    {
        $chapters = Chapter::whereHas('lesson')->orderBy("order")->get();
        $locales = Language::orderBy("order")->get();
        $listenings = Listening::orderBy("order")->get();

        return view('livewire.edit.listening-edit',[
            "listenings" => $listenings,
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
