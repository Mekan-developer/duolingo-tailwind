<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ListeningRequest extends FormRequest
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
            'chapter_id'=> 'required|exists:chapters,id',
            'lesson_id' => 'required|exists:lessons,id',
            'exercise_id' => 'required|exists:list_exercises,id',
            'status' => 'nullable',
            'order' => 'nullable|integer'
        ];

        if(request()->isMethod("POST")) {
            $data['audio'] = 'required|file|mimes:mp3|max:10240';
        }else{
            $data['audio'] = 'nullable|file|mimes:mp3|max:10240';
        }
        return $data;
    }
}
