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
            'name' => $this->name,
            // 'dopamine1' => $this->getDopamine($this->dopamine_image1),
            // 'dopamine2' => $this->getDopamine($this->dopamine_image2),
            // 'dopamine3' => $this->getDopamine($this->dopamine_image3),
            // 'dopamine4' => $this->getDopamine($this->dopamine_image4),
            'chapter_id' => $this->chapter_id,

        ];
    }
}
