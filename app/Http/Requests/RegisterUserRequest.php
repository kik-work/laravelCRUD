<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; //anyone can access
    }

  
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
        ];
    }
    public function messages()
    {
         return [
            'name.required' => 'Please enter your name!',
            'email.required' => 'Email is mandatory!',
            'email.unique' => 'Email already exists!',
            'password.min' => 'Password must be at least 8 characters!',
        ];
    }
}
