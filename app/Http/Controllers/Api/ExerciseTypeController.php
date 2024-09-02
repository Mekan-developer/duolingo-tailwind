<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ExerciseTypeResource;
use App\Models\ExerciseType;
use Illuminate\Http\Request;

class ExerciseTypeController extends Controller
{
    public function index(){
        $exerciseType = ExerciseTypeResource::collection(ExerciseType::all());
        return response()->json($exerciseType,200);
    }
}
