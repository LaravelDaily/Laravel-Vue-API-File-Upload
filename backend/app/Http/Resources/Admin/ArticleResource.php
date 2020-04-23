<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Resources\Json\JsonResource;

class ArticleResource extends JsonResource
{
    public function toArray($request)
    {
        return array_merge(parent::toArray($request), [
            'thumbnail_url' => env('APP_URL') . $this->resource->thumbnail->url
        ]);
    }
}
