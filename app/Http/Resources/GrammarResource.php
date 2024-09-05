<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GrammarResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        //  'grammar_theory','text','text_correct_parts','text_incorrect_parts','audio','chapter_id','lesson_id','exercise_id','status','order'
         
        return [
            "id"=> $this->id,  
            "theory_text" => $this->getTranslations('grammar_theory'),
            "^^^^^^^^^^^" => "^^^^^^^^^^",
            "practice_text" => $this->getTranslations("text"),
            "practice_text_correct" => $this->text_correct_parts,
            "practice_text_incorrect" => $this->text_incorrect_parts,
            'audio' => $this->getSound(),         
            "chapter_id" => $this->chapter_id,
            "lesson_id" => $this->lesson_id,
            "exercise_id" => $this->exercise_id,
            "type_id" => $this->type_id
        ];
    }
}
