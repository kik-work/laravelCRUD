<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentRequest extends FormRequest
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
            'post_id'=>'required|integer',
            'comment_text'=>'required|string|max:255',
            'comment_reactions'=>'nullable|integer|min:0'
        ];
    }
    public function messages()
    {
         return [
            'post_id'=>'Post ID is missing',
            'comment_text.required' => 'Please enter a comment!',
            'comment_reactions.required' => 'Comment reaction is mandatory!',
        ];
    }
}
