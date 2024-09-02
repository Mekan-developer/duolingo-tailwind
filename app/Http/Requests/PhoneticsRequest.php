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

        return [
            'phonetic_alphabet' => 'required|string|max:255',
            'phonetic_text.*' => 'required|string',
            'example1' => 'required|string|max:255', 
            'sound1'=> 'required|file|mimes:mp3|max:10240',
            'example2' => 'required|string|max:255', 
            'sound2'=> 'required|file|mimes:mp3|max:10240',
            'example3' => 'required|string|max:255', 
            'sound3'=> 'required|file|mimes:mp3|max:10240',
            'example4' => 'required|string|max:255', 
            'sound4'=> 'required|file|mimes:mp3|max:10240',
            'example5' => 'required|string|max:255', 
            'sound5' => 'required|file|mimes:mp3|max:10240',

            'chapter_id'=> 'required|exists:chapters,id',
            'lesson_id' => 'required|exists:lessons,id',
            'exercise_id' => 'required|exists:list_exercises,id',
            'status' => 'nullable',
            'order' => 'nullable|integer'
        ];
    }
}
