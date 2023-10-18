<?php

namespace App\Http\Resources\V1\FinancialEngineering\TradingPlan;

use App\Http\Resources\V1\Market\Market\MarketSummaryResource;
use App\Http\Resources\V1\Trading\Account\AccountSummaryResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TradingPlanResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     *
     * @return array
     */
    public function toArray($request)
    {
        return [
            'uuid' => $this->id,
            'instruments' => $this->instruments,
            'daily_start' => $this->daily_start,
            'daily_finish' => $this->daily_finish,
            'daily_finish_exit' => $this->daily_finish_exit,
            'max_daily_trades' => $this->max_daily_trades,
            'public' => $this->public,
            'status' => $this->status,
            'trading_account' => AccountSummaryResource::make($this->tradingAccount),
            'market' => MarketSummaryResource::make($this->market),
        ];
    }
}
