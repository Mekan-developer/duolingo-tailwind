<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InformationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $this->lessons = json_decode($this->lessons);
        $this->exercises = json_decode($this->exercises);
        return [
            "id"=> $this->id,
            "lessons" => $this->lessons,           
            "exercises" => $this->exercises, 
            "informations" => $this->getTranslations('information'),
            "part" => $this->part, 

        ];
    }
}
