<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\LanguageResource;
use App\Models\Language;
use Illuminate\Http\Request;

class LanguageController extends Controller
{
    public function index(){
        $languages = LanguageResource::collection(Language::orderBy('order')->get());
        return response()->json($languages,200);
    }
}
