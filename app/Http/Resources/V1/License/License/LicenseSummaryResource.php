<?php

namespace App\Http\Resources\V1\License\License;

use App\Http\Resources\V1\Tag\TagResource as TagSummeryResource;
use Illuminate\Http\Resources\Json\JsonResource;

class LicenseSummaryResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'uuid'             => $this->id,
            'key_type'         => $this->key_type,
            'public_key'       => $this->public_key,
        ];
    }
}
