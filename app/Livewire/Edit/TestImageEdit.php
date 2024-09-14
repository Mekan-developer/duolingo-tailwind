<?php

namespace App\Livewire\Edit;

use App\Models\Chapter;
use App\Models\Language;
use App\Models\Lesson;
use App\Models\List_exercise;
use App\Models\TestImage;
use Livewire\Component;

class TestImageEdit extends Component
{
    public $testImage,$lessons,$exercises,$lesson_id,$exercise_id;
    public $selectedChapter = null,$selectedLesson = null;
    public $switch_lesson = false, $switch_exercise = false;

    public function mount($testImage,$lessons,$exercises)
    {
        $this->testImage = $testImage;
        $this->selectedLesson = $testImage->lesson_id;
        $this->exercise_id = $testImage->exercise_id;
        $this->selectedChapter = $testImage->chapter_id;
        $this->lessons = $lessons;
        $this->exercises = $exercises;
    }
    public function render()
    {
        $chapters = Chapter::whereHas('lessonOption')->orderBy("order")->get();
        $locales = Language::orderBy("order")->get();

        $testImages = TestImage::orderBy("order")->get();

        return view('livewire.edit.test-image-edit',[
            "testImages" => $testImages,
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
