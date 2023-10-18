<?php

namespace App\Http\Resources\V1\FinancialEngineering\TradingStrategy;

use App\Http\Resources\V1\FinancialEngineering\MoneyManagement\MoneyManagementSummaryResource;
use App\Http\Resources\V1\FinancialEngineering\RiskManagement\RiskManagementSummaryResource;
use App\Http\Resources\V1\FinancialEngineering\TradingPlan\TradingPlanSummaryResource;
use App\Http\Resources\V1\Market\Market\MarketSummaryResource;
use App\Http\Resources\V1\Trading\Account\AccountSummaryResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TradingStrategyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     *
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'time_frame' => $this->time_frame,
            'exit_on_friday' => $this->exit_on_friday,
            'exit_end_of_day' => $this->exit_end_of_day,
            'minimum_stop_loss' => $this->minimum_stop_loss,
            'maximum_stop_loss' => $this->maximum_stop_loss,
            'minimum_target_price' => $this->minimum_target_price,
            'maximum_target_price' => $this->maximum_target_price,
            'maximum_spread' => $this->maximum_spread,
            'maximum_slippage' => $this->maximum_slippage,
            'entry_triggers_count' => $this->entry_triggers_count,
            'exit_triggers_count' => $this->exit_triggers_count,
            'public' => $this->public,
            'status' => $this->status,
            'market' => MarketSummaryResource::make($this->market),
            'trading_account' => AccountSummaryResource::make($this->tradingAccount),
            'risk_management' => RiskManagementSummaryResource::make($this->riskManagement),
            'money_management' => MoneyManagementSummaryResource::make($this->moneyManagement),
            'trading_plan' => TradingPlanSummaryResource::make($this->tradingPlan),
        ];
    }
}
