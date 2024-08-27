<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ChapterResource;
use App\Models\Chapter;
use Illuminate\Http\Request;

class ChapterController extends Controller
{
    public function index(){
        $chapters = ChapterResource::collection(Chapter::orderBy("order")->get());

        return response()->json($chapters,200);
    }
}
