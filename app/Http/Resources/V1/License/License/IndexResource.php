<?php

namespace App\Http\Resources\V1\License\License;

use App\Http\Resources\V1\License\Version\VersionSummaryResource;
use App\Http\Resources\V1\Post\PostSummaryResource;
use Illuminate\Http\Resources\Json\JsonResource;

class IndexResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'uuid'                             => $this->id,
            'version'                          => $this->whenLoaded('version', fn() => VersionSummaryResource::make($this->version)),
            'post'                             => $this->whenLoaded('post', fn() => PostSummaryResource::make($this->post)),
            'key_type'                         => $this->key_type,
            'private_key'                      => $this->private_key,
            'public_key'                       => $this->public_key,
            'max_terminals'                    => $this->max_terminals,
            'max_accounts'                     => $this->max_accounts,
            'allowed_markets'                  => $this->allowed_markets,
            'allowed_brokers'                  => $this->allowed_brokers,
            'allowed_countries'                => $this->allowed_countries,
            'is_real'                          => $this->is_real,
            'max_balance'                      => $this->max_balance,
            'max_equity'                       => $this->max_equity,
            'max_volume'                       => $this->max_volume,
            'max_orders'                       => $this->max_orders,
            'max_symbols'                      => $this->max_symbols,
            'max_timeframes'                   => $this->max_timeframes,
            'is_lifetime'                      => $this->is_lifetime,
            'is_trial'                         => $this->is_trial,
            'status'                           => $this->status,
        ];
    }
}
