<?php

namespace App\Http\Resources\V1\Market\Broker;

use App\Http\Resources\V1\Market\Market\MarketSummaryResource;
use Illuminate\Http\Resources\Json\JsonResource;

class BrokerListResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'uuid'         => $this->id,
            'market'                 => $this->whenLoaded('market', fn() => MarketSummaryResource::make($this->market)),
            'name'                   => $this->name,
            'logo'                   => $this->logo,
            'website'                => $this->website,
            'description'            => $this->description,
            'is_dealing_desk'        => $this->is_dealing_desk,
            'is_stp'                 => $this->is_stp,
            'is_ecn'                 => $this->is_ecn,
            'is_market_maker'        => $this->is_market_maker,
            'is_ndd'                 => $this->is_ndd,
            'is_dma'                 => $this->is_dma,
            'is_prime_of_prime'      => $this->is_prime_of_prime,
            'has_swap_free'          => $this->has_swap_free,
            'has_demo_account'       => $this->has_demo_account,
            'has_mobile_trading'     => $this->has_mobile_trading,
            'has_web_trading'        => $this->has_web_trading,
            'status'                 => $this->status,
        ];
    }
}
