<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GrammarRequest extends FormRequest
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
            'grammar_theory.*' => 'required|string',
            'text.*' => 'required|string',
            'hint.*' => 'required|string',
            'text_correct_parts.*' => 'required|string',
            'text_incorrect_parts.*' => 'required|string',            
            'chapter_id'=> 'required|exists:chapters,id',
            'lesson_id' => 'required|exists:lessons,id',
            'status' => 'nullable',
            'order' => 'nullable|integer'
        ];

        if($this->isMethod('post')){
            $rules['audio'] = 'required|file|max:10000';
        }else{
            $rules['audio'] = 'nullable|file|max:10000';
        }

        return $rules;
    }
}
