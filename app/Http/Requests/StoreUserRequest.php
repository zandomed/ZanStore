<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends BaseFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array{
        return [
            'name.required' => 'A name is required',
            'name.string' => 'A name must be a string',
            'name.max' => 'A name must be less than 255 characters',
            'email.required' => 'An email is required',
            'email.string' => 'An email must be a string',
            'email.email' => 'An email must be a valid email address',
            'email.max' => 'An email must be less than 255 characters',
            'email.unique' => 'An email must be unique',
            'password.required' => 'A password is required',
            'password.string' => 'A password must be a string',
            'password.min' => 'A password must be at least 8 characters',
            'password.confirmed' => 'A password must be confirmed in the password_confirmation field',
        ];
    }
}
