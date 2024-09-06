<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VocabularyRequest extends FormRequest
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
            'en_text' => 'required|string|max:255',
            'chapter_id' => 'required|exists:chapters,id',
            'lesson_id' => 'required|exists:lessons,id',
            'exercise_id' => 'required|exists:list_exercises,id',
            'translations_word.*' => 'required|string|max:255'
        ];

        if(request()->isMethod("POST")) {
            $data['image'] = 'required|file|mimes:webp,jpeg,png,jpg,gif,svg|max:10240';
            $data['audio'] = 'required|file|mimes:mp3|max:10240';
        }else{
            $data['image'] = 'nullable|file|mimes:webp,jpeg,png,jpg,gif,svg|max:10240';
            $data['audio'] = 'nullable|file|mimes:mp3|max:10240';
        }

        return $data;
    }
}
