<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\LessonResource;
use App\Models\Lesson;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    /**
     * @OA\Get(
     *      path="/lessons",
     *      tags={"lessons"},
     *      summary="Get all lessons",
     *      description="Получение всех уроки",
     *      @OA\Response(response=200,description="lessons retrived successfully")
     * )
     */

    public function index(){
        $lessons = LessonResource::collection(Lesson::orderBy('order')->get());
        return response()->json($lessons,200);
    }
}
