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
    public $audioTranslation,$lessons,$exercises,$lesson_id,$exercise_id;
    public $selectedChapter = null,$selectedLesson = null;
    public $switch_lesson = false, $switch_exercise = false;

    public function mount($audioTranslation,$lessons,$exercises)
    {
        $this->audioTranslation = $audioTranslation;
        $this->selectedChapter = $audioTranslation->chapter_id;
        $this->selectedLesson = $audioTranslation->lesson_id;
        $this->exercise_id = $audioTranslation->exercise_id;
        $this->lessons = $lessons;
        $this->exercises = $exercises;
    }
    public function render()
    {
        $chapters = Chapter::whereHas('lessonOption')->orderBy("order")->get();
        $locales = Language::orderBy("order")->get();
        $audioTranslations = AudioTranslation::orderBy("order")->get();

        return view('livewire.edit.audio-translation-edit',[
            "audioTranslations" => $audioTranslations,
            "chapters" => $chapters,
            "lessons" => $this->lessons,
            "exercises" =>$this->exercises,
            "locales" => $locales
        ]);
    }

    public function selectedChapterHandle()
    {

        $this->switch_lesson = true;$selectedLesson = null;
        $this->exercises = null;$this->lessons = null;
        $this->lessons = Lesson::whereHas('listExercise')->where('chapter_id',$this->selectedChapter)->orderBy('order')->get();

    }
 
    public function selectedLessonHandle(){
        $this->exercise_id = null;$this->switch_exercise = true;$this->exercises = null;
        $this->exercises = List_exercise::where('lesson_id',$this->selectedLesson)->orderBy('order')->get(); 
    }

}
