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
            // 'title.*' => 'required|string|max:255', 
            'name' => 'required|string|max:255', 
            'chapter_id' => 'required|exists:chapters,id',
        ];   

        if(request()->isMethod('POST')){
            $rules['dopamine_image1'] = "required|file|mimes:webp,jpeg,png,jpg,gif,svg|max:10240";
            $rules['dopamine_image2'] = "required|file|mimes:webp,jpeg,png,jpg,gif,svg|max:10240";
            $rules['dopamine_image3'] = "required|file|mimes:webp,jpeg,png,jpg,gif,svg|max:10240";
            $rules['dopamine_image4'] = "required|file|mimes:webp,jpeg,png,jpg,gif,svg|max:10240";
        }else{
            $rules['dopamine_image1'] = "nullable|file|mimes:webp,jpeg,png,jpg,gif,svg|max:10240";
            $rules['dopamine_image2'] = "nullable|file|mimes:webp,jpeg,png,jpg,gif,svg|max:10240";
            $rules['dopamine_image3'] = "nullable|file|mimes:webp,jpeg,png,jpg,gif,svg|max:10240";
            $rules['dopamine_image4'] = "nullable|file|mimes:webp,jpeg,png,jpg,gif,svg|max:10240";
        }   
        return $rules;
    }
}
