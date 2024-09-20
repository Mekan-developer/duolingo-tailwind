<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\LanguageResource;
use App\Models\Language;
use Illuminate\Http\Request;

class LanguageController extends Controller
{

    /**
     * @OA\Get(
     *      path="/languages",
     *      tags={"Languages"},
     *      summary="Get all languages",
     *      description="Get list of languages",
     *      @OA\Response(response=200,description="Languages retrived successfully")
     * )
     */
    
    public function index(){
        $languages = LanguageResource::collection(Language::orderBy('order')->get());
        return response()->json($languages,200);
    }
}
