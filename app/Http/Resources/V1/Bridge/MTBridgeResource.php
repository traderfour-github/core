<?php

namespace App\Http\Resources\V1\Bridge;

use App\Http\Resources\V1\Trading\Account\SummaryResource;
use Illuminate\Http\Resources\Json\JsonResource;

class MTBridgeResource extends JsonResource
{

    private array|object $response ;


    public function toArray($request): array
    {
        return [
            'trading_account'  => SummaryResource::make($this->trading_account),
            'command'          => $this->command,
            'arguments'        => $this->arguments,
            'response'         => $this->response,
        ]  ;
    }


    public function setResponse(array|object $attributes)
    {
        $this->response = $attributes;
        return $this;
    }
}
