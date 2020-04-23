<?php

namespace App\Http\Requests;

use App\Article;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StoreArticleRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title' => ['required', 'string'],
            'content' => ['required', 'string'],
            'thumbnail'   => ['image', 'dimensions:max_width=1000,max_height=1000'],
        ];

    }
}
