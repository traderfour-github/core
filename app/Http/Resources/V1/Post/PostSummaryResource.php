<?php

namespace App\Http\Resources\V1\Post;

use App\Jobs\V1\GetGeneralImageLinkJob;
use Illuminate\Http\Resources\Json\JsonResource;

class PostSummaryResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'uuid'         => $this->id,
            'title'        => $this->title,
            'slogan'       => $this->slogan,
            'logo'         => isset($this->logo_id) ? dispatch_sync(new GetGeneralImageLinkJob($this->logo->path)) : null,
            'type'         => $this->type,
            'status'       => $this->status,
            'published_at' => $this->published_at,
        ];
    }
}
