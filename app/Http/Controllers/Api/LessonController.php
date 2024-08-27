<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\LessonResource;
use App\Models\Lesson;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    public function index(){
        $lessons = LessonResource::collection(Lesson::orderBy('order')->get());
        return response()->json($lessons,200);
    }
}
