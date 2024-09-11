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
    public $countExamples = 1,$phonetics,$lessons,$exercises,$phoneticsExamples,$lesson_id,$exercise_id,$maxSoundKey;
    public $selectedChapter = null,$selectedLesson = null;
    public $switch_lesson = false, $switch_exercise = false;

    public $removeSoundNumber=0;

    public function mount($phonetics,$lessons,$exercises)
    {
        $this->phonetics = $phonetics;        
        $this->phoneticsExamples = json_decode($this->phonetics);
        
        $decode = (array) $this->phoneticsExamples->examples;
        $maxKey = max(array_keys($decode));
        $this->maxSoundKey = $maxKey;


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

//     public function updated()
// {
//     $this->phoneticsExamples = json_decode($this->phonetics);
        
//     $decode = (array) $this->phoneticsExamples->examples;
//     $maxKey = max(array_keys($decode));
//     $this->maxSoundKey = $maxKey;

// }

    public function addExamples(){
        $decode = (array) $this->phoneticsExamples->examples;
        $maxKey = max(array_keys($decode));
        $decode[$maxKey+1] = '';
        $this->maxSoundKey = $maxKey + 1;
        $this->phoneticsExamples->examples = (object) $decode;
    }
    public function removeExamples($index){
        $decode = (array) $this->phoneticsExamples->examples;
        unset($decode[$index]); // Remove the element by index
        $this->phoneticsExamples->examples = (object) $decode;
        $this->maxSoundKey--;
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

    public function removeSoundCount(){
        $this->removeSoundNumber++;
    }
}
