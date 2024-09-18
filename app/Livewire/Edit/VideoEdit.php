<?php

namespace App\Livewire\Edit;

use App\Models\Chapter;
use App\Models\Language;
use App\Models\Lesson;
use App\Models\List_exercise;
use App\Models\Video;
use App\Models\Vocabulary;
use Livewire\Component;

class VideoEdit extends Component
{
    public $video,$lessons,$lesson_id,$exercise_id;
    public $selectedChapter = null,$selectedLesson = null;
    public $switch_lesson = false;

    public function mount($video,$lessons)
    {
        $this->video = $video; 
        $this->selectedChapter = $video->chapter_id;
        $this->selectedLesson = $video->lesson_id;
        $this->exercise_id = $video->exercise_id;
        $this->lessons = $lessons;
    }
    public function render()
    {
        $chapters = Chapter::whereHas('lesson')->orderBy("order")->get();
        $locales = Language::orderBy("order")->get();
        $videos = Video::orderBy("order")->get();

        return view('livewire.edit.video-edit',[
            "videos" => $videos,
            "chapters" => $chapters,
            "lessons" => $this->lessons,
            "locales" => $locales
        ]);
    }

    public function selectedChapterHandle()
    {
        // Reset lesson-related properties
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
    //     $this-> = null;
    //     $this-> = List_exercise::where('lesson_id',$this->selectedLesson)->orderBy('order')->get(); 
    // }
    public function switchExerciseChange(){
        $this->switch_exercise = false;
    }
}
