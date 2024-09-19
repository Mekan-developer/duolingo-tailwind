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
            'part' => (int) $request->phonetics_type,
        ]);


        Information::create($request->all());
        return redirect()->route('information.index')->with('success','Information created successfully!');
    }

    public function edit(Information $information){
        return view("pages.informations.edit")->with('information', $information);
    }

    public function update(InformationRequest $request, Information $information){
        $request->merge([
            'lessons' => json_encode($request->lesson_ids),
            'exercises' => json_encode($request->exercise_ids),
            'part' => (int) $request->phonetics_type,
        ]);

        $information->update($request->all());

        return redirect()->route('information.index')->with('success','Information updated successfully');
    }

    public function destroy(Information $information){    
        $information->delete();
        return redirect()->route('information.index');
    }
    
    public function active(Information $information){
        if($information->status == '1'){
            $information->status = '0';
        }else{
            $information->status = '1';
        }
            $information->save();
        return redirect()->route('information.index');
    }
}
