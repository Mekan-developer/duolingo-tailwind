<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PhoneticsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {

        $rules = [
            'chapter_id' => 'required|exists:chapters,id',
            'lesson_id' => 'required|exists:lessons,id',
            'exercise_id' => 'required|exists:list_exercises,id',
            'phonetic_alphabet' => 'required',
            'phonetic_text.*' => 'required',
            'examples.*' => 'required|string|max:255',
            'status' => 'nullable',
            'order' => 'nullable|integer'
        ];

        if(request()->isMethod("POST")) {
            $rules['sound1'] = 'required|file|mimes:mp3,wav,aac,ogg|max:10240';            
            $rules['sound2'] = 'required|file|mimes:mp3,wav,aac,ogg|max:10240';            
            $rules['sound3'] = 'required|file|mimes:mp3,wav,aac,ogg|max:10240';            
            $rules['sound4'] = 'required|file|mimes:mp3,wav,aac,ogg|max:10240';            
            $rules['sound5'] = 'required|file|mimes:mp3,wav,aac,ogg|max:10240';
            $rules['audio'] = 'required|file|mimes:mp3,wav,aac,ogg|max:10240';            
        }else{
            $rules['sound1'] = 'nullable|file|mimes:mp3,wav,aac,ogg|max:10240';            
            $rules['sound2'] = 'nullable|file|mimes:mp3,wav,aac,ogg|max:10240';            
            $rules['sound3'] = 'nullable|file|mimes:mp3,wav,aac,ogg|max:10240';            
            $rules['sound4'] = 'nullable|file|mimes:mp3,wav,aac,ogg|max:10240';            
            $rules['sound5'] = 'nullable|file|mimes:mp3,wav,aac,ogg|max:10240';  
            $rules['audio'] = 'nullable|file|mimes:mp3,wav,aac,ogg|max:10240';          
        }


        return $rules;
    }
}
