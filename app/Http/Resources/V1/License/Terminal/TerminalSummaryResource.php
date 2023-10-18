<?php

namespace App\Http\Resources\V1\License\Terminal;

use App\Http\Resources\V1\Tag\TagResource as TagSummeryResource;
use Illuminate\Http\Resources\Json\JsonResource;

class TerminalSummaryResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'uuid'             => $this->id,
            'name'             => $this->name,
            'assigned_by'      => $this->assigned_by,
        ];
    }
}
