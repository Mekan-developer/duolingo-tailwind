<?php

namespace App\Livewire\Edit;

use App\Models\Chapter;
use App\Models\Language;
use App\Models\Lesson;
use App\Models\List_exercise;
use App\Models\Pronunciation;
use Livewire\Component;

class PronunciationEdit extends Component
{
    public $pronunciation,$lessons,$exercises,$lesson_id,$exercise_id;
    public $selectedChapter = null,$selectedLesson = null;
    public $switch_lesson = false, $switch_exercise = false;

    public function mount($pronunciation,$lessons,$exercises)
    {
        $this->pronunciation = $pronunciation;
        $this->selectedLesson = $pronunciation->lesson_id;
        $this->exercise_id = $pronunciation->exercise_id;
        $this->selectedChapter = $pronunciation->chapter_id;
        $this->lessons = $lessons;
        $this->exercises = $exercises;
    }
    public function render()
    {
        $chapters = Chapter::whereHas('lessonOption')->orderBy("order")->get();
        $locales = Language::orderBy("order")->get();

        $pronunciations = Pronunciation::orderBy("order")->get();

        return view('livewire.edit.pronunciation-edit',[
            "pronunciations" => $pronunciations,
            "chapters" => $chapters,
            "lessons" => $this->lessons,
            "exercises" =>$this->exercises,
            "locales" => $locales
        ]);
    }

    public function selectedChapterHandle()
    {
        $this->selectedLesson = null;
        $this->switch_lesson = true;
        $this->lesson_id = null;
        $this->exercise_id = null;
        $this->exercises = null;
        $this->lessons = Lesson::whereHas('listExercise')->where('chapter_id',$this->selectedChapter)->orderBy('order')->get();

    }
 
    public function selectedLessonHandle(){
        $this->switch_exercise = true;
        $this->switch_lesson = false;
        $this->exercise_id = null;
        $this->exercises = null;
        $this->exercises = List_exercise::where('lesson_id',$this->selectedLesson)->orderBy('order')->get(); 
    }
    public function switchExerciseChange(){
        $this->switch_exercise = false;
    }
}
