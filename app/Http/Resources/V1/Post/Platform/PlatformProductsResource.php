<?php

namespace App\Http\Resources\V1\Post\Platform;

use Illuminate\Http\Resources\Json\JsonResource;

class PlatformProductsResource extends JsonResource
{

    public function toArray($request): array
    {
        return [
            'uuid'         => $this->id,
            'title'        => $this->title,
            'slogan'       => $this->slogan,
            'introduction' => $this->introduction,
            'description'  => $this->description,
            'logo'         => $this->logo,
            'cover'        => $this->cover,
            'downloads'    => $this->downloads,
            'views'        => $this->views,
            'purchases'    => $this->purchases,
            'likes'        => $this->likes,
            'type'         => $this->type,
            'status'       => $this->status,
            'published_at' => $this->published_at,
            'updated_at'   => $this->updated_at
        ];
    }
}
