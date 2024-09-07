<?php

namespace App\Livewire\Edit;

use App\Models\Chapter;
use App\Models\Language;
use App\Models\Lesson;
use App\Models\List_exercise;
use App\Models\Phonetics;
use Livewire\Component;

class PhoneticsEdit extends Component
{
    public $countExamples = 1,$phonetics,$lessons,$exercises,$lesson_id,$exercise_id;
    public $selectedChapter = null,$selectedLesson = null;
    public $switch_lesson = false, $switch_exercise = false;

    public function mount($phonetics,$lessons,$exercises)
    {
        $this->phonetics = $phonetics;
        $this->selectedLesson = $phonetics->lesson_id;
        $this->exercise_id = $phonetics->exercise_id;
        $this->selectedChapter = $phonetics->chapter_id;
        $this->lessons = $lessons;
        $this->exercises = $exercises;
    }
    public function render()
    {
        $chapters = Chapter::whereHas('lessonOption')->orderBy("order")->get();
        $locales = Language::orderBy("order")->get();

        $phoneticss = Phonetics::orderBy("order")->get();
        return view('livewire.edit.phonetics-edit',[
            "phoneticss" => $phoneticss,
            "chapters" => $chapters,
            "lessons" => $this->lessons,
            "exercises" =>$this->exercises,
            "locales" => $locales
        ]);
    }

    public function addExamples(){
        $this->countExamples++;
    }
    public function removeExamples(){
        $this->countExamples--;
    }

    public function selectedChapterHandle()
    {
        $this->switch_lesson = true;$this->lesson_id = null;$this->exercise_id = null;
        $this->exercises = null;$this->lessons = null;
        $this->lessons = Lesson::whereHas('listExercise')->where('chapter_id',$this->selectedChapter)->orderBy('order')->get();

    }
 
    public function selectedLessonHandle(){
        $this->exercise_id = null;$this->switch_exercise = true;$this->exercises = null;
        $this->exercises = List_exercise::where('lesson_id',$this->selectedLesson)->orderBy('order')->get(); 
    }
}
