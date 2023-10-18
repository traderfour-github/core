<?php

namespace App\Http\Resources\V1\Market\Platform;

use Illuminate\Http\Resources\Json\JsonResource;

class PlatformSummeryResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'uuid'         => $this->id,
            'title'          => $this->title,
            'slug'           => $this->slug,
            'icon'           => $this->icon,
        ];
    }
}
