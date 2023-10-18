<?php

namespace App\Http\Resources\V1\License\Version;

use App\Http\Resources\V1\Market\Platform\PlatformSummeryResource;
use App\Http\Resources\V1\Post\PostSummaryResource;
use Illuminate\Http\Resources\Json\JsonResource;

class SingleResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'uuid'                             => $this->id,
            'platform'                         => $this->whenLoaded('platform', fn() => PlatformSummeryResource::make($this->platform)),
            'post'                             => $this->whenLoaded('post', fn() => PostSummaryResource::make($this->post)),
            'title'                            => $this->title,
            'signature'                        => $this->signature,
            'file'                              => $this->file, //todo: attach upload file
            'user_manual'                      => $this->user_manual,
            'change_log'                       => $this->change_log,
            'update_type'                      => $this->update_type,
            'major'                            => $this->major,
            'minor'                            => $this->minor,
            'patch'                            => $this->patch,
            'force'                            => $this->force,
            'downloads'                        => $this->downloads,
            'requests'                         => $this->requests,
            'published_at'                     => $this->published_at,
            'last_update'                      => $this->last_update,
            'status'                           => $this->status,
        ];
    }
}
