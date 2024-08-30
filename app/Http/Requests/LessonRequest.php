<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LessonRequest extends FormRequest
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
            'title.*' => 'required|string|max:255', // Title is required, must be a string, and has a max length of 255 characters
            'chapter_id' => 'required|exists:chapters,id',
            'dopamine_image_*' => "required|file|mimes:webp,jpeg,png,jpg,gif,svg|max:10240",

        ];

        if(request()->isMethod('PATCH')){
            $rules['dopamine_image_*'] = "nullable|file|mimes:webp,jpeg,png,jpg,gif,svg|max:10240";
        }   
        return $rules;
    }
}
