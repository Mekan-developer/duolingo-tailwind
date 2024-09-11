<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VideoRequest extends FormRequest
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
            'status' => 'nullable',
            'order' => 'nullable|integer'
        ];

        if(request()->isMethod("POST")){
            $rules['video'] = 'required|file|mimetypes:video/mp4|max:15240';
        }else{
            $rules['video'] = 'nullable|file|mimetypes:video/mp4|max:15240';
        }

        return $rules;
    }
}
