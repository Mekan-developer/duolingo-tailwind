<?php

namespace App\Http\Controllers\Exercises;

use App\Http\Controllers\Controller;
use App\Http\Requests\GrammarRequest;
use App\Models\Grammar;
use App\Models\Language;
use App\Models\Lesson;
use App\Models\List_exercise;
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
        $request->merge([
            'text_correct_parts' => json_encode($request->text_correct_parts),
            'text_incorrect_parts' => json_encode($request->text_incorrect_parts)
        ]);
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

    public function edit(Grammar $grammar){
        $lessons = Lesson::where('chapter_id', $grammar->chapter_id)->orderBy('order')->get();
       
        return view("pages.allExercises.grammar_theory.edit")->with("grammar",$grammar)->with("lessons",$lessons);
    }

    public function update(GrammarRequest $request, Grammar $grammar){        
        $grammars = Grammar::all();
        $this->sortItems($grammars, $grammar->order, $request->order);//for ordering elements

        $request->merge([
            'text_correct_parts' => json_encode($request->text_correct_parts),
            'text_incorrect_parts' => json_encode($request->text_incorrect_parts)
        ]);

        $data = $request->all();
        
        // Removing grammar start
        $text_correct_parts = $grammar->text_correct_parts; // Assuming 'text_correct_parts' is a JSON column
        $text_correct_partsArray = json_decode($text_correct_parts, true); 
        $countRemoveElement = count(array_keys($text_correct_partsArray)); 

        if ($request->removeInputNumber > 0) {
            $removeLastItem = $request->removeInputNumber;

            while ($removeLastItem > 0 && $countRemoveElement > 0) {
                // Remove the last item from the JSON array
                unset($text_correct_partsArray[$countRemoveElement]);

                // Repeat for 'text_incorrect_parts' if applicable
                $text_incorrect_parts = $grammar->text_incorrect_parts;
                $text_incorrect_partsArray = json_decode($text_incorrect_parts, true);
                unset($text_incorrect_partsArray[$countRemoveElement]);

                // Decrement counters
                $removeLastItem--;
                $countRemoveElement--;
            }

            // Save the updated JSON arrays back to the database
            $grammar->text_correct_parts = json_encode($text_correct_partsArray);
            $grammar->text_incorrect_parts = json_encode($text_incorrect_partsArray);
            $grammar->save();
        }
        // Removing grammar end

        if ($request->hasFile('audio')) {
            if ($grammar->audio) {
                $this->removeFile($grammar->audio, 'grammars');
            } 
            $random = hexdec(uniqid());
            $filename = $random . '.' . $request->audio->extension();
            Storage::disk('grammars')->putFileAs('', $request->audio,$filename);
            $data = $request->all();
            $data['audio'] = $filename;
        }


        if($request->hintChecker == null){
            $grammar->forgetTranslations('hint', true);
        }
        
        try {
            $grammar->update($data); 
            return redirect()->route('grammar.index')->with('success','grammar updated successfully');
        } catch (\Exception $e) {
            \Log::error('Error updating grammar: ' . $e->getMessage());
            return redirect()->back()->with('error','There was a problem saving the grammar.');
        }
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
