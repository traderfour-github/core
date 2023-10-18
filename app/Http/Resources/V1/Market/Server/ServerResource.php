<?php

namespace App\Http\Resources\V1\Market\Server;

use App\Http\Resources\V1\Market\Broker\BrokerSummaryResource;
use App\Http\Resources\V1\Market\Market\MarketSummaryResource;
use App\Http\Resources\V1\Market\Platform\PlatformSummeryResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ServerResource extends JsonResource
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
            'market'      => MarketSummaryResource::make($this->market),
            'broker'      => BrokerSummaryResource::make($this->broker),
            'platform'    => PlatformSummeryResource::make($this->platform),
        ];
    }
}
