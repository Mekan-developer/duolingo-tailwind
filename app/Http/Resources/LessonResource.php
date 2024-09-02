<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LessonResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->getTranslations('title'),
            'chapter_id' => $this->chapter_id,
            'dopamine1' => $this->getDopamine($this->dopamine_image_1),
            'dopamine2' => $this->getDopamine($this->dopamine_image_2),
            'dopamine3' => $this->getDopamine($this->dopamine_image_3),
            'dopamine4' => $this->getDopamine($this->dopamine_image_4),

        ];
    }
}
