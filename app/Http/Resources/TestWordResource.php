<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TestWordResource extends JsonResource
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
            "question_word" => $this->getTranslations('translations_word'),
            "correct_text" => $this->en_correct_text,
            "incorrect_text" => $this->en_incorrect_text,
            'audio' => $this->getAudio(),           
            "chapter_id" => $this->chapter_id,
            "lesson_id" => $this->lesson_id,
            "exercise_id" => $this->exercise_id
        ];
    }
}
