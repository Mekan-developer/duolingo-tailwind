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
    public $video,$lessons,$exercises,$lesson_id,$exercise_id;
    public $selectedChapter = null,$selectedLesson = null;
    public $switch_lesson = false, $switch_exercise = false;

    public function mount($video,$lessons,$exercises)
    {
        $this->video = $video;
        $this->selectedChapter = $video->chapter_id;
        $this->selectedLesson = $video->lesson_id;
        $this->exercise_id = $video->exercise_id;
        $this->lessons = $lessons;
        $this->exercises = $exercises;
    }
    public function render()
    {
        $chapters = Chapter::whereHas('lessonOption')->orderBy("order")->get();
        $locales = Language::orderBy("order")->get();
        $videos = Video::orderBy("order")->get();

        return view('livewire.edit.video-edit',[
            "videos" => $videos,
            "chapters" => $chapters,
            "lessons" => $this->lessons,
            "exercises" =>$this->exercises,
            "locales" => $locales
        ]);
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
