<?php

namespace App\Http\Controllers\Exercises;

use App\Http\Controllers\Controller;
use App\Http\Requests\GrammarRequest;
use App\Models\Grammar;
use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Storage;

class GrammarController extends Controller
{
    public function index(Request $request){

        $grammars = Grammar::orderBy('order');
        $data = $this->selectOPtionOrderExercise($request,$grammars,'grammars');

        $textPartCounts = DB::table('grammars')->selectRaw('MAX(JSON_LENGTH(text_correct_parts)) as max_length')->value('max_length');

        return view("pages.allExercises.grammar_theory.index",$data,compact('textPartCounts'));
    }


    public function create(){
        $locales = Language::where("status",1)->orderBy('order')->get();
        return view("pages.allExercises.grammar_theory.create",compact("locales"));
    }

    public function store(GrammarRequest $request){

        if ($request->hasFile('audio')) {
            $random = hexdec(uniqid());
            $filename = $random . '.' . $request->audio->extension();
            Storage::disk('grammars')->putFileAs('', $request->audio,$filename);
            $data = $request->all();
            $data['audio'] = $filename;

        }
        
        Grammar::create($data);
        return redirect()->route('grammar.index')->with('success','grammar successfully created!');

    }




    public function destroy(Grammar $grammar){
        if ($grammar->audio) {
            $this->removeFile($grammar->audio, 'grammars');
        } 
        $orderDeletedRow = $grammar->order;
        $delete_success = $grammar->delete();

        // sorting order
        if( $delete_success ){
            $table = Grammar::orderBy('order', 'asc')->get();
            $this->reorderAfterRemoval($table,$orderDeletedRow);
        }
        return redirect()->route('grammar.index')->with('success','grammar deleted successfully');
    }

    public function active(Grammar $grammar){
        if($grammar->status == '1'){
            $grammar->status = '0';
        }else{
            $grammar->status = '1';
        }
            $grammar->save();

        return redirect()->route('grammar.index');
    }
}
