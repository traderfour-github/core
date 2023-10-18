<?php

namespace App\Http\Resources\V1\License\Version;

use App\Http\Resources\V1\Tag\TagResource as TagSummeryResource;
use Illuminate\Http\Resources\Json\JsonResource;

class VersionSummaryResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'uuid'          => $this->id,
            'title'         => $this->title,
            'signature'     => $this->signature,
        ];
    }
}
