<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
    
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
            'post_title' => 'required|string|max:255',
            'post_summary' => 'required|string|max:255',
            
        ];
    }
    public function messages()
    {
         return [
            'post_title.required' => 'Please enter post_title!',
            'post_summary.required' => 'post summary is mandatory!',
           ];
    }
}
