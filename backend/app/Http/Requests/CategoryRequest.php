<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name'   => 'required|min:2',
            'path'   => 'required',
            'status'   => 'required',
            'menu'   => 'required',
            'description'   => 'required',
            'parent_id'   => 'required',
        ];
    }
}
