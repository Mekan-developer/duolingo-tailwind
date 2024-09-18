<?php

namespace App\Livewire\Create;

use App\Models\Chapter;
use App\Models\Language;
use App\Models\Lesson;
use App\Models\List_exercise;
use Livewire\Component;

class GrammarTheoryCreate extends Component
{
    public $countWordParts = 1, $lessons=null;
    public $selectedChapter, $selectedLesson, $showDiv = false;

    public function mount(){
        if (session()->hasOldInput('chapter_id') && old('chapter_id') > 0) {
            $this->selectedChapter = old('chapter_id');
            $this->selectedChapterHandle();
        }
        if (session()->hasOldInput('lesson_id') && old('lesson_id') > 0) {
            $this->selectedLesson = old('lesson_id');
        }
    }

    public function render()
    {
        $chapters = Chapter::whereHas('lesson')->orderBy('order')->get();
        $locales = Language::where("status",1)->orderBy('order')->get();

        return view('livewire.create.grammar-theory-create',[
            'chapters' => $chapters,
            'locales' => $locales,
            'countWordParts' => $this->countWordParts,
        ]);
    }

    public function addTextField(){
        $this->countWordParts++;
    }
    public function removeTextField(){
        $this->countWordParts--;
    }
    

    public function selectedChapterHandle()
    {
        $this->lessons = Lesson::where('chapter_id',$this->selectedChapter)->orderBy('order')->get(); 
    }


    public function toggle(){
        $this->showDiv = !$this->showDiv;
    }
}
