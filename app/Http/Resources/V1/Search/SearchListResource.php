<?php

namespace App\Http\Resources\V1\Search;

use App\Http\Resources\V1\Post\PostListResource;
use Illuminate\Http\Resources\Json\JsonResource;

class SearchListResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'products' => PostListResource::collection($this['products']),
        ];
    }
}
