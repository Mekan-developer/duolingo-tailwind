<?php

namespace App\Http\Controllers\Exercises;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GrammarController extends Controller
{
    public function index(){

        return view("pages.allExercises.");
    }
}
