<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;

class PhoneticResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {      
        $data = [
            "id"=> $this->id,
            "phonetic_alphabet" => $this->phonetic_alphabet,
            "phonetic_text" => $this->getTranslations('phonetic_text'),
            'alphabet_sound' => $this->getSound($this->audio),
            "^^^^^^^^^^^^" => "^^^^^^^^^^^^^^^^"
        ];

        $maxLength = DB::table('phonetics')->selectRaw('MAX(JSON_LENGTH(examples)) as max_length')->value('max_length');
        for ($i = 1; $i <= $maxLength; $i++) {
            $data['word'.$i] = $this->translate('examples',$i);
            $data['sound'.$i] = $this->getSound($this->translate('sounds',$i));
        }

        $data['chapter_id'] = $this->chapter_id;
        $data['lesson_id'] = $this->lesson_id;
        $data['exercise_id'] = $this->exercise_id;
        $data['type_id'] = $this->type_id;

        return $data;
    }
}
