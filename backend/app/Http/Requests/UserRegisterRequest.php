<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRegisterRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name'            => 'required|max:20',
            'email'           => 'email|required|unique:users,email',
            'password'        => 'required|min:6',
            'age'             => 'nullable|numeric',
            'prefecture_code' => 'nullable|numeric'
        ];
    }
}
