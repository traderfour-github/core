<?php

namespace App\Http\Resources\V1\Market\Platform;

use Illuminate\Http\Resources\Json\JsonResource;

class PlatformResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'uuid'         => $this->id,
            'title'          => $this->title,
            'slug'           => $this->slug,
            'icon'           => $this->icon,
            'cover'          => $this->cover,
            'description'    => $this->description,
            'content'        => $this->content,
            'url'            => $this->url,
            'email'          => $this->email,
            'privacy_policy' => $this->privacy_policy,
            'terms_of_use'   => $this->terms_of_use,
            'address'        => $this->address,
            'permissions'    => $this->permissions,
            'oss'            => $this->oss,
            'status'         => $this->status,
        ];
    }
}
