<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SpellingResource extends JsonResource
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
            'image' => $this->getImage(),           
            "chapter_id" => $this->chapter_id,
            "lesson_id" => $this->lesson_id,
            "exercise_id" => $this->exercise_id,
            "type_id" => $this->type_id
        ];
    }
}
