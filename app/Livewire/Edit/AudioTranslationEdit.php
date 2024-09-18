<?php

namespace App\Livewire\Edit;

use App\Models\AudioTranslation;
use App\Models\Chapter;
use App\Models\Language;
use App\Models\Lesson;
use App\Models\List_exercise;
use Livewire\Component;

class AudioTranslationEdit extends Component
{
    public $audioTranslation,$lessons,$lesson_id;
    public $selectedChapter = null,$selectedLesson = null;
    public $switch_lesson = false, $switch_exercise = false;

    public function mount($audioTranslation,$lessons)
    {
        $this->audioTranslation = $audioTranslation;
        $this->selectedChapter = $audioTranslation->chapter_id;
        $this->selectedLesson = $audioTranslation->lesson_id;
        $this->lessons = $lessons;
    }
    public function render()
    {
        $chapters = Chapter::whereHas('lesson')->orderBy("order")->get();
        $locales = Language::orderBy("order")->get();
        $audioTranslations = AudioTranslation::orderBy("order")->get();

        return view('livewire.edit.audio-translation-edit',[
            "audioTranslations" => $audioTranslations,
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
        $this->exercise_id = null;
        $this->lessons = Lesson::where('chapter_id',$this->selectedChapter)->orderBy('order')->get();
    }


}
