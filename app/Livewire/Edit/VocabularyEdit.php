<?php

namespace App\Livewire\Edit;

use App\Models\Chapter;
use App\Models\Language;
use App\Models\Lesson;
use App\Models\List_exercise;
use App\Models\Vocabulary;
use Livewire\Component;

class VocabularyEdit extends Component
{
    public $vocabulary,$lessons,$lesson_id,$exercise_id;
    public $selectedChapter = null,$selectedLesson = null;
    public $switch_lesson = false, $switch_exercise = false;

    public function mount($vocabulary,$lessons,)
    {
        $this->vocabulary = $vocabulary;
        $this->selectedLesson = $vocabulary->lesson_id;
        $this->exercise_id = $vocabulary->exercise_id;
        $this->selectedChapter = $vocabulary->chapter_id;
        $this->lessons = $lessons;
    }
    public function render()
    {
        $chapters = Chapter::whereHas('lesson')->orderBy("order")->get();
        $locales = Language::orderBy("order")->get();

        $vocabularies = Vocabulary::orderBy("order")->get();
        return view('livewire.edit.vocabulary-edit',[
            "vocabularies" => $vocabularies,
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
 
    // public function selectedLessonHandle(){
    //     $this->switch_exercise = true;
    //     $this->switch_lesson = false;
    //     $this->exercise_id = null;
    //     $this->exercises = Exercise::where('lesson_id',$this->selectedLesson)->orderBy('order')->get(); 
    // }

    public function switchExerciseChange(){
        $this->switch_exercise = false;
    }
}
