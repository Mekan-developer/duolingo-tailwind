<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LanguageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);
        return [

            'id' => $this->id,
            'locale' => $this->locale,
            'name' => $this->name,
            'native' => $this->native,
            'flag' => $this->getFlag()
        ];
    }
}
