<?php

namespace App\Http\Resources\V1\Trading\Account;

use App\Http\Resources\V1\Tag\TagResource as TagSummeryResource;
use Illuminate\Http\Resources\Json\JsonResource;

class AccountSummaryResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'uuid'          => $this->id,
            'name'          => $this->name,
            'identity'      => $this->identity,
            'currency'      => $this->currency,
            'balance'       => $this->balance,
            'equity'        => $this->equity,
            'tags'          => $this->whenLoaded('tags', fn() => TagSummeryResource::collection($this->tags)),
            'status'        => $this->status,
        ];
    }
}
