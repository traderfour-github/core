<?php

namespace App\Http\Resources\V1\Market\Broker;

use Illuminate\Http\Resources\Json\JsonResource;

class BrokerSummaryResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'uuid'                   => $this->id,
            'name'                   => $this->name,
            'logo'                   => $this->logo,
        ];
    }
}
