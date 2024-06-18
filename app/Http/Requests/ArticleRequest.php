<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
{
    /**
     * @return string[]
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|min:3|max:100|unique:articles,title',
            'content' => 'required|string|min:3',
        ];
    }
}
