<?php

namespace App\Http\Controllers;

use App\Models\Exercise;
use Illuminate\Http\Request;

class ExerciseController extends Controller
{
    public function index(){

        $exercises = Exercise::orderBy('order')->get();
        return view('pages.exercises.index',['exercises' => $exercises]);
    }
}
