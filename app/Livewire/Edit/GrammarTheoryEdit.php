<?php

namespace App\Livewire\Edit;

use App\Models\Chapter;
use App\Models\Grammar;
use App\Models\Language;
use App\Models\Lesson;
use App\Models\List_exercise;
use Livewire\Component;

class GrammarTheoryEdit extends Component
{

    public $countWordParts = 1, $lessons,$lesson_id;
    public $selectedChapter = null,$selectedLesson = null;
    public $switch_lesson = false,$showDiv = false;
    public $maxTextCorrectPartsKey;
    
    public $grammar, $text_correct_parts ,$text_incorrect_parts, $removeInputNumber=0;
    
    public function mount($grammar,$lessons,)
    {           
        $this->text_correct_parts = json_decode($this->grammar->text_correct_parts,true);
        $this->text_incorrect_parts = json_decode($this->grammar->text_incorrect_parts,true);
        $this->grammar = $grammar;  
        $hintChecker = json_decode($this->grammar,true);

        if($hintChecker['hint'] != null){
            $this->showDiv = true;
        }
        $maxKey = max(array_keys($this->text_correct_parts));
        $this->maxTextCorrectPartsKey = $maxKey;

        $this->selectedLesson = $grammar->lesson_id;
        $this->selectedChapter = $grammar->chapter_id;
        $this->lessons = $lessons;
    }
    public function render()
    {

        $chapters = Chapter::whereHas('lesson')->orderBy("order")->get();
        $locales = Language::orderBy("order")->get();

        $grammars = Grammar::orderBy("order")->get();

        return view('livewire.edit.grammar-theory-edit',[
            "grammars" => $grammars,
            "chapters" => $chapters,
            "lessons" => $this->lessons,
            "locales" => $locales,
        ]);
    }

    public function addTextField(){
        $decode = (array) $this->text_correct_parts;
        $maxKey = max(array_keys($decode));
        $decode[$maxKey+1] = '';
        $this->maxTextCorrectPartsKey = $maxKey + 1;
        $this->text_correct_parts = (array) $decode;
        $this->text_incorrect_parts = (array) $decode;
    }
    public function removeTextField($index){
        $decode = (array) $this->text_correct_parts;
        unset($decode[$index]);
        $adjustedArr = [];
        $count = 1; // Start from 1 to keep the key 1 as it is
        foreach ($decode as $key => $value) {
            $adjustedArr[$count++] = $value;
        }
        $this->text_correct_parts = (array) $adjustedArr;
        $this->maxTextCorrectPartsKey--;
    }


    public function selectedChapterHandle()
    {
        $this->selectedLesson = null;
        $this->switch_lesson = true;
        $this->lesson_id = null;
        $this->lessons = Lesson::where('chapter_id',$this->selectedChapter)->orderBy('order')->get();
    }
 
    public function removeFieldCount(){
        $this->removeInputNumber++;
    }

    public function toggle(){
        $this->showDiv = !$this->showDiv;
    }
}
