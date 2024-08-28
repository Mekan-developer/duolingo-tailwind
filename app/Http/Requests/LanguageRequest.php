<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LanguageRequest extends FormRequest
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
        $rules =  [
            'name' => "required|string|unique:languages,name",
            'native' => "required|string|unique:languages,native",
            'locale' => "required|string|unique:languages,locale",
            'flag' => "nullable|file|unique:languages,flag|mimes:webp,jpeg,png,jpg,gif,svg|max:10240", //10mb
        ];

        if($this->isMethod('post')){
            $rules['flag'] = "required|file|unique:languages,flag|mimes:webp,jpeg,png,jpg,gif,svg|max:10240";
        }

        return $rules;
    }
}
