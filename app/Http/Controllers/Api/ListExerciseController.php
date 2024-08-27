<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ListExerciseResource;
use App\Models\List_exercise;
use Illuminate\Http\Request;

class ListExerciseController extends Controller
{
    public function index(Request $request){
        $listExercise = ListExerciseResource::collection(List_exercise::orderBy('order')->get());
        return response()->json($listExercise,200);
    }
}
