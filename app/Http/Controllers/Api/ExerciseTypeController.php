<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ExerciseTypeResource;
use App\Models\ExerciseType;
use Illuminate\Http\Request;

class ExerciseTypeController extends Controller
{
    /**
     * @OA\Get(
     *      path="/exercise-types",
     *      tags={"exercise-types"},
     *      summary="Get all type of exercise",
     *      description="Получение всех типов кода упражнений",
     *      @OA\Response(response=200,description="type code retrived successfully")
     * )
     */
    public function index(){
        $exerciseType = ExerciseTypeResource::collection(ExerciseType::all());
        return response()->json($exerciseType,200);
    }
}
