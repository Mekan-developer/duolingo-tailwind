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

        $data = [
            'chapter_id' => 'required|exists:chapters,id',
            'lesson_id' => 'required|exists:lessons,id',
            'exercise_id' => 'required|exists:list_exercises,id',
            'phonetic_alphabet' => 'required',
            'status' => 'nullable',
            'order' => 'nullable|integer'
        ];

        if(request()->isMethod("POST")) {
            $data['audio'] = 'required|file|mimes:mp3|max:10240';
            $data['sounds.*'] = 'required|file|mimes:mp3|max:10240';
            $data['examples.*'] = 'required|string|max:255';
            
        }else{
            $data['audio'] = 'nullable|file|mimes:mp3|max:10240';
            $data['sounds.*'] = 'nullable|file|mimes:mp3|max:10240';
            $data['examples.*'] = 'nullable|string|max:255';
            
        }

        return $data;
    }
}
