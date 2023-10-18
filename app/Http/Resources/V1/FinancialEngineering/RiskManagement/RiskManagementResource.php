<?php

namespace App\Http\Resources\V1\FinancialEngineering\RiskManagement;

use App\Http\Resources\V1\Trading\Account\AccountSummaryResource;
use Illuminate\Http\Resources\Json\JsonResource;

class RiskManagementResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'uuid' => $this->id,
            'title' => $this->title,
            'max_risk' => $this->max_risk,
            'max_risk_mode' => $this->max_risk_mode,
            'max_risk_calculation' => $this->max_risk_calculation,
            'is_max_risk_relative' => $this->is_max_risk_relative,
            'max_daily_risk' => $this->max_daily_risk,
            'max_daily_risk_mode' => $this->max_daily_risk_mode,
            'max_daily_risk_calculation' => $this->max_daily_risk_calculation,
            'risk_per_chart' => $this->risk_per_chart,
            'risk_per_chart_mode' => $this->risk_per_chart_mode,
            'risk_per_chart_calculation' => $this->risk_per_chart_calculation,
            'risk_per_trade' => $this->risk_per_trade,
            'risk_per_trade_mode' => $this->risk_per_trade_mode,
            'risk_per_trade_calculation' => $this->risk_per_trade_calculation,
            'risk_reward_ratio' => $this->risk_reward_ratio,
            'positive_correlation' => $this->positive_correlation,
            'negative_correlation' => $this->negative_correlation,
            'low_correlation' => $this->low_correlation,
            'hedge' => $this->hedge,
            'required_stop_loss' => $this->required_stop_loss,
            'required_target_profit' => $this->required_target_profit,
            'news_trading' => $this->news_trading,
            'allowed_instruments' => $this->allowed_instruments,
            'allowed_times' => $this->allowed_times,
            'allowed_order_types' => $this->allowed_order_types,
            'public' => $this->public,
            'trading_account' => AccountSummaryResource::make($this->tradingAccount),
        ];
    }
}
