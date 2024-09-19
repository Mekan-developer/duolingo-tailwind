<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TranslationTestResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id"=> $this->id,
            "text" => $this->en_text,
            'audio' => $this->getAudio(),
            "correct_translations" => $this->getTranslations('translation_correct_words'),           
            "incorrect_translations" => $this->getTranslations('translation_incorrect_words'),           
            "chapter_id" => $this->chapter_id,
            "lesson_id" => $this->lesson_id,
            "exercise_id" => $this->exercise_id,
            // "type_id" => $this->type_id
        ];
    }
}
