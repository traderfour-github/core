<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class TradingPlatformResource extends JsonResource
{

    public function toArray($request): array
    {
        return [
            'driver'        => $this->driver,
            'account_id'    => $this->account_id,
            'command'       => $this->command,
            'arguments'     => $this->arguments
        ];
    }
}
