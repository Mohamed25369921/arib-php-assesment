<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DepartmentRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Authorization logic can be added here
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255|unique:departments,name,' . $this->route('department'),
        ];
    }
}
