<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class EmployeeStoreRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Authorization logic can be added here
    }

    public function rules()
    {
        return [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => [
                'required',
                'string',
                Password::min(8)
                    ->letters()
                    ->mixedCase()
                    ->numbers()
                    ->symbols(),
            ],
            'salary' => 'required|numeric|min:0',
            'department_id' => 'required|exists:departments,id',
            'manager_id' => 'nullable|exists:users,id',
            'image' => 'nullable|image|max:2048',
        ];
    }
}
