<?php

namespace App\Http\Controllers;

use App\Http\Requests\LanguageRequest;
use App\Models\Language;
use Illuminate\Http\Request;

class LanguageController extends Controller
{

    public function index(){
        $languages = Language::orderBy('order')->get();

        return view("pages.languages.index",compact("languages"));
    }

    public function store(LanguageRequest $request){
        $data = [
            "name"=> $request->name,
            "native" => $request->native,
            "locale" => $request->locale,
        ];
        
        if ($request->hasFile('flag')) {            
            $image = $request->flag;
            $imageName = $this->uploadFile($image,'lang_icons',true);
            $data['flag'] = $imageName;
        }

        Language::create($data);

        return redirect()->route('language.index')->with('success','Language created successfully!'); 
    }

    public function edit(Language $language){
        $languages = Language::orderBy('order')->get();
        $lang['edit'] = true;
        $lng = $language;
        return view('pages.languages.index',compact('languages','lang','lng'));
    }

    public function update(LanguageRequest $request){
        $language = Language::find($request->language);
        $data = [
            "name"=> $request->name,
            "native" => $request->native,
            "locale" => $request->locale,
        ];

        if ($request->hasFile('flag')) {            
            $image = $request->flag;
            $imageName = $this->uploadFile($image,'lang_icons',true);
            $data['flag'] = $imageName;
        }

        $languages = Language::all();
        $this->sortItems($languages, $language->order, $request->order);
        $data['order'] = $request->order;

        $language->update($data);

        return redirect('/languages')->with('success','Language updated successfully!'); ;
    }

    public function destroy(Language $language){    
        if ($language->flag) {
            $this->removeFile($language->flag, 'lang_icons');
        } 
        $orderDeletedRow = $language->order;
        $delete_success = $language->delete();

        // sorting order
        if( $delete_success ){
            $table = Language::orderBy('order', 'asc')->get();
            $this->reorderAfterRemoval($table,$orderDeletedRow);
        }
        // end sorting order

        return redirect()->route('language.index');
    }


    public function active(Language $language){

        if($language->status == '1'){
            $language->status = '0';
        }else{
            $language->status = '1';
        }
            $language->save();
        return redirect()->route('language.index');
    }
}
