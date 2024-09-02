<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\VocabularyResource;
use App\Models\Vocabulary;
use Illuminate\Http\Request;

class VocabularyController extends Controller
{
    public function index(Request $request){
        $listExercise = VocabularyResource::collection(Vocabulary::orderBy('order')->get());
        return response()->json($listExercise,200);
    }
}
