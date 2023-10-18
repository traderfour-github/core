<?php

namespace App\Http\Resources\V1\Market\Market;

use Illuminate\Http\Resources\Json\JsonResource;

class ChildMarketResource extends JsonResource
{

    public function toArray($request): array
    {
        return [
            'uuid'         => $this->id,
            'name'        => $this->name,
            'slug'        => $this->slug,
            'icon'        => $this->icon,
            'url'         => $this->url,
            'description' => $this->description,
            'cover'       => $this->cover,
            'status'      => $this->status,
        ];
    }
}
