<?php

namespace App\Http\Resources\V1\Market\Market;

use Illuminate\Http\Resources\Json\JsonResource;

class ChildMarketListResource extends JsonResource
{

    public function toArray($request): array
    {
        return [
            'uuid'         => $this->id,
            'name'        => $this->name,
            'slug'        => $this->slug,
            'icon'        => $this->icon,
            'cover'       => $this->cover,
            'status'      => $this->status,
        ];
    }
}
