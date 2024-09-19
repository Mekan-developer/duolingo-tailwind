<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ExerciseResource;
use App\Models\Exercise;
use Illuminate\Http\Request;

class ExerciseController extends Controller
{
     /**
     * @OA\Get(
     *      path="/list-exercise",
     *      tags={"list-exercise"},
     *      summary="Get all list-exercise",
     *      description="Получение всех список-упражнение",
     *      @OA\Response(response=200,description="list-exercise retrived successfully")
     * )
     */

     public function index(Request $request){
        $Exercise = ExerciseResource::collection(Exercise::orderBy('order')->get());
        return response()->json($Exercise,200);
    }
}
