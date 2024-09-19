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
    
    public $grammar, $grammarExamples , $removeInputNumber=0;
    
    public function mount($grammar,$lessons,)
    {   
        // $text_correct_parts = json_decode($grammarExamples->text_correct_parts,true);
        // $text_incorrect_parts = json_decode($grammarExamples->text_incorrect_parts,true);
        
        $this->grammarExamples = json_decode($grammar);
        $this->grammar = $grammar;   

        if($this->grammarExamples->hint != null){
            $this->showDiv = true;
        }

        $decode = (array) $this->grammarExamples->text_correct_parts;
        $maxKey = max(array_keys($decode));
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
            "locales" => $locales
        ]);
    }

    public function addTextField(){
        $decode = (array) $this->grammarExamples->text_correct_parts;
        $maxKey = max(array_keys($decode));
        $decode[$maxKey+1] = '';
        $this->maxTextCorrectPartsKey = $maxKey + 1;
        $this->grammarExamples->text_correct_parts = (object) $decode;
        $this->grammarExamples->text_incorrect_parts = (object) $decode;
    }
    public function removeTextField($index){
        $decode = (array) $this->grammarExamples->text_correct_parts;
        unset($decode[$index]); // Remove the element by index
        $this->grammarExamples->text_correct_parts = (object) $decode;
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
