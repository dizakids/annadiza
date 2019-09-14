<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleStoreRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title' => 'required|max:100',
            'body'  => 'required:2000',
            'image' => 'required|file|image|max:2048',
            'author' => 'required|max:100',
            'text' => 'required|max:300',
            'status' => 'required|max:100',
            'home' => 'required|max:100',
            'category_id' => 'required',

        ];
    }
}
