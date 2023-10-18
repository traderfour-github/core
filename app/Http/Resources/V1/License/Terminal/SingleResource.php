<?php

namespace App\Http\Resources\V1\License\Terminal;

use App\Http\Resources\V1\Trading\Account\AccountSummaryResource;
use Illuminate\Http\Resources\Json\JsonResource;

class SingleResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'uuid'                             => $this->id,
            'trading_account'                  => $this->whenLoaded('tradingAccount', fn() => AccountSummaryResource::make($this->tradingAccount)),
            'assigned_by'                      => $this->assigned_by,
            'bulut_id'                         => $this->bulut_id,
            'ip_address'                       => $this->ip_address,
            'mac_address'                      => $this->mac_address,
            'name'                             => $this->name,
            'version'                          => $this->version,
            'build'                            => $this->build,
            'path'                             => $this->path,
            'language'                         => $this->language,
            'country'                          => $this->country,
            'timezone'                         => $this->timezone,
            'installed_at'                     => $this->installed_at,
            'last_seen'                        => $this->last_seen,
            'status'                           => $this->status,
        ];
    }
}
