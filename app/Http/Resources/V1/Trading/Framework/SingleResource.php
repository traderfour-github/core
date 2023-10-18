<?php

namespace App\Http\Resources\V1\Trading\Framework;

use App\Http\Resources\V1\FinancialEngineering\MoneyManagement\MoneyManagementSummaryResource;
use App\Http\Resources\V1\FinancialEngineering\RiskManagement\RiskManagementSummaryResource;
use App\Http\Resources\V1\FinancialEngineering\TradingPlan\TradingPlanSummaryResource;
use App\Http\Resources\V1\Market\Market\MarketSummaryResource;
use App\Http\Resources\V1\Trading\Account\AccountSummaryResource;
use Illuminate\Http\Resources\Json\JsonResource;

class SingleResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'uuid'                             => $this->id,
            'market'                           => $this->whenLoaded('market', fn() => MarketSummaryResource::make($this->market)),
            'trading_account'                  => $this->whenLoaded('tradingAccount', fn() => AccountSummaryResource::make($this->tradingAccount)),
            'risk_management'                  => $this->whenLoaded('riskManagement', fn() => RiskManagementSummaryResource::make($this->riskManagement)),
            'trading_plan'                     => $this->whenLoaded('tradingPlan', fn() => TradingPlanSummaryResource::make($this->tradingPlan)),
            'money_management'                 => $this->whenLoaded('moneyManagement', fn() => MoneyManagementSummaryResource::make($this->moneyManagement)),
            'title'                            => $this->title,
            'reverse_positioning'              => $this->reverse_positioning,
            'trail_entry_step'                 => $this->trail_entry_step,
            'trail_entry_stop'                 => $this->trail_entry_stop,
            'virtual_price'                    => $this->virtual_price,
            'magic_number'                     => $this->magic_number,
            'max_slippage'                     => $this->max_slippage,
            'max_spread'                       => $this->max_spread,
            'position_management'              => $this->position_management,
            'partial_close'                    => $this->partial_close,
            'partial_close_calculation'        => $this->partial_close_calculation,
            'risk_free_step'                   => $this->risk_free_step,
            'risk_free_calculation'            => $this->risk_free_calculation,
            'risk_free_extras'                 => $this->risk_free_extras,
            'risk_free_swap_calculate'         => $this->risk_free_swap_calculate,
            'trail_stop_loss'                  => $this->trail_stop_loss,
            'trail_stop_loss_calculation'      => $this->trail_stop_loss_calculation,
            'trail_stop_loss_step'             => $this->trail_stop_loss_step,
            'trail_stop_loss_step_calculation' => $this->trail_stop_loss_step_calculation,
            'max_anti_martingale'              => $this->max_anti_martingale,
            'consecutive_stop_hits'            => $this->consecutive_stop_hits,
            'anti_martingale_multiplier'       => $this->anti_martingale_multiplier,
            'reward_multiplier_method'         => $this->reward_multiplier_method,
            'reward_multiplier_setting'        => $this->reward_multiplier_setting,
            'nearest_trade'                    => $this->nearest_trade,
            'rounded_numbers_zero_digits'      => $this->rounded_numbers_zero_digits,
            'rounded_numbers_max_distance'     => $this->rounded_numbers_max_distance,
            'max_daily_profit'                 => $this->max_daily_profit,
            'max_daily_profit_mode'            => $this->max_daily_profit_mode,
            'max_daily_profit_calculation'     => $this->max_daily_profit_calculation,
            'max_daily_loss'                   => $this->max_daily_loss,
            'max_daily_loss_mode'              => $this->max_daily_loss_mode,
            'max_daily_loss_calculation'       => $this->max_daily_loss_calculation,
            'equity_protector'                 => $this->equity_protector,
            'equity_protector_mode'            => $this->equity_protector_mode,
            'equity_protector_stop_out'        => $this->equity_protector_stop_out,
            'session_london'                   => $this->session_london,
            'session_london_start'             => $this->session_london_start,
            'session_london_end'               => $this->session_london_end,
            'session_new_york'                 => $this->session_new_york,
            'session_new_york_start'           => $this->session_new_york_start,
            'session_new_york_end'             => $this->session_new_york_end,
            'session_sydney'                   => $this->session_sydney,
            'session_sydney_start'             => $this->session_sydney_start,
            'session_sydney_end'               => $this->session_sydney_end,
            'session_tokyo'                    => $this->session_tokyo,
            'session_tokyo_start'              => $this->session_tokyo_start,
            'session_tokyo_end'                => $this->session_tokyo_end,
            'session_frankfurt'                => $this->session_frankfurt,
            'session_frankfurt_start'          => $this->session_frankfurt_start,
            'session_frankfurt_end'            => $this->session_frankfurt_end,
            'news_trading'                     => $this->news_trading,
            'news_trading_before'              => $this->news_trading_before,
            'news_trading_after'               => $this->news_trading_after,
            'news_trading_impact'              => $this->news_trading_impact,
            'opposite_trading'                 => $this->opposite_trading,
            'close_trades_on_weekend'          => $this->close_trades_on_weekend,
            'status'                           => $this->status,
        ];
    }
}
