<?php

namespace App\Http\Resources\V1\FinancialEngineering\CashFlows;

use App\Http\Resources\V1\Market\Market\MarketSummaryResource;
use App\Http\Resources\V1\Trading\Account\AccountSummaryResource;
use Illuminate\Http\Resources\Json\JsonResource;

class CashFlowResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'uuid'            => $this->id,
            'title'           => $this->title,
            'description'     => $this->description,
            'public'          => $this->public,
            'till'            => $this->till,
            'from'            => $this->from,
            'status'          => $this->status,
            'market'          => MarketSummaryResource::make($this->market),
            'trading_account' => AccountSummaryResource::make($this->tradingAccount),
        ];
    }
}
