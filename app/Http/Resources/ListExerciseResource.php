<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ListExerciseResource extends JsonResource
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
            "name" => $this->name,
            // "title" => $this->getTranslations('title'),
            "chapter_id" => $this->chapter_id,
            "lesson_id" => $this->lesson_id
        ];
    }
}
