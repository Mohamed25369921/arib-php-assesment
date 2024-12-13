<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $this->user()->id],
            'password' => [
                'required',
                'string',
                'confirmed',
                Password::min(8) // Minimum 8 characters
                    ->letters() // At least one letter
                    ->mixedCase() // At least one uppercase and one lowercase letter
                    ->numbers() // At least one number
                    ->symbols(), // At least one special character
            ],
        ];
    }
}
