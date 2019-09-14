<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserUpdateRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name'            => 'required|max:20',
            'email'           => ['required', 'email', Rule::unique('users')->ignore($this->user)],
            'password'        => 'nullable|min:6',
            'age'             => 'nullable|numeric',
            'prefecture_code' => 'nullable|numeric',

        ];
    }
}
