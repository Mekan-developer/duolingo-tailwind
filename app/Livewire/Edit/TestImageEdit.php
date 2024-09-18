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
    public $testImage,$lessons,$lesson_id;
    public $selectedChapter = null,$selectedLesson = null;
    public $switch_lesson = false;

    public function mount($testImage,$lessons)
    {
        $this->testImage = $testImage;
        $this->selectedLesson = $testImage->lesson_id;
        $this->selectedChapter = $testImage->chapter_id;
        $this->lessons = $lessons;
    }
    public function render()
    {
        $chapters = Chapter::whereHas('lesson')->orderBy("order")->get();
        $locales = Language::orderBy("order")->get();

        $testImages = TestImage::orderBy("order")->get();

        return view('livewire.edit.test-image-edit',[
            "testImages" => $testImages,
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
