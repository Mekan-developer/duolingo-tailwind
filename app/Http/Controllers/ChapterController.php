<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChapterRequest;
use App\Models\Chapter;
use App\Models\Language;
use Illuminate\Http\Request;

class ChapterController extends Controller
{
    public function index(){
        $chapters = Chapter::orderBy("order")->paginate(10);
        $locales = Language::where("status",1)->get("locale");

        return view("pages.chapters.index", compact("chapters","locales"));
    }

    public function create(){
        $locales = Language::where("status",1)->orderBy('order')->get("locale");

        return view("pages.chapters.create", compact("locales"));
    }

    public function store(ChapterRequest $request){    
        Chapter::create($request->all());  

        return redirect()->route('chapters');
    }

    public function destroy(Chapter $chapter){
        $orderDeletedRow = $chapter->order;
        $delete_success = $chapter->delete();

        // sorting order
        if( $delete_success ){
            $table = Chapter::orderBy('order', 'asc')->get();
            $this->reorderAfterRemoval($table,$orderDeletedRow);
        }
        // end sorting order

        return redirect()->route('chapters');
    }
}
