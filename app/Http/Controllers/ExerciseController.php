<?php

namespace App\Http\Controllers;

use App\Http\Requests\ExerciseRequest;
use App\Models\Exercise;
use Illuminate\Http\Request;

class ExerciseController extends Controller
{
    public function index(){
        $gotoLinks = [       
                1 => 'vocabulary.index',
                2 => 'questionWord.index',
                3 => 'video.index',
                4 => 'audioTranslation.index',
                5 => 'questionImage.index',
                6 => 'spelling.index',
                7 => 'pronunciation.index',
                8 => 'grammar.index',
                9 => 'testImage.index',
                10 => 'testWord.index',
                11 => 'listening.index',
          
        ];
        $exercises = Exercise::orderBy('order')->get();
        return view('pages.exercises.index',['exercises' => $exercises, 'gotoLinks' => $gotoLinks]);
    }

    public function edit(Exercise $exercise){
        $exercises = Exercise::orderBy("order")->get();

        return view('pages.exercises.edit', compact('exercise','exercises'));
    }

    public function update(ExerciseRequest $request,Exercise $exercise){
        $exercises = Exercise::all();
        $this->sortItems($exercises, $exercise->order, $request->order);

        $exercise->update($request->all());

        return redirect()->route('exercises')->with('success','exercise updated successfully!');
    }
}
