<?php

namespace App\Http\Resources\V1\Market\Server;

use Illuminate\Http\Resources\Json\JsonResource;

class ServerSummaryResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'uuid'        => $this->id,
            'title'       => $this->title,
            'address'     => $this->address,
            'ip_type'     => $this->ip_type,
            'port'        => $this->port,
            'is_official' => $this->is_official,
            'is_public'   => $this->is_public,
        ];
    }
}
