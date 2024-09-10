<?php

namespace App\Http\Controllers;

use App\Http\Requests\InformationRequest;
use App\Models\Information;
use App\Models\Language;
use Illuminate\Http\Request;

class InformationController extends Controller
{
    


    public function index(){
        $informations = Information::all();
        $locales = Language::all();
        return view("pages.informations.index",compact('informations','locales'));
    }

    public function create(){

        return view("pages.informations.create");
    }

    public function store(InformationRequest $request){

        $request->merge([
            'lessons' => json_encode($request->lesson_ids),
            'exercises' => json_encode($request->exercise_ids),
        ]);

        Information::create($request->all());

            return redirect()->route('information.index')->with('success','Information created successfully!');
    }

}
