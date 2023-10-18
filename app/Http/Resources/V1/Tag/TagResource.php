<?php

namespace App\Http\Resources\V1\Tag;

use Illuminate\Http\Resources\Json\JsonResource;

class TagResource extends JsonResource
{

    public function toArray($request): array
    {
        return [
            'uuid'         => $this->id,
          'title'   => $this->title,
          'slug'    => $this->slug
        ];
    }
}
