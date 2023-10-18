<?php

namespace App\Http\Requests\V1\Trading\Framework;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title'     => ['nullable', 'string', 'max:255'],
            'trading_account_id'   => ['required', 'bail', 'string', Rule::exists('trading_accounts', 'id')],
            'market_id'   => ['nullable', 'bail', 'string', Rule::exists('markets', 'id')],
            'risk_management_id'   => ['nullable', 'bail', 'string', Rule::exists('risk_managements', 'id')],
            'trading_plan_id'   => ['nullable', 'bail', 'string', Rule::exists('trading_plans', 'id')],
            'money_management_id'   => ['nullable', 'bail', 'string', Rule::exists('money_managements', 'id')],
            'reverse_positioning'   => ['nullable', 'bail'],
            'trail_entry_step'   => ['nullable', 'bail'],
            'trail_entry_stop'   => ['nullable', 'bail'],
            'virtual_price'   => ['nullable', 'bail'],
            'magic_number'   => ['nullable', 'bail'],
            'max_slippage'   => ['nullable', 'bail'],
            'max_spread'   => ['nullable', 'bail'],
            'position_management'   => ['nullable', 'bail'],
            'partial_close'   => ['nullable', 'bail'],
            'partial_close_calculation'   => ['nullable', 'bail'],
            'risk_free_step'   => ['nullable', 'bail'],
            'risk_free_calculation'   => ['nullable', 'bail'],
            'risk_free_extras'   => ['nullable', 'bail'],
            'risk_free_swap_calculate'   => ['nullable', 'bail'],
            'trail_stop_loss'   => ['nullable', 'bail'],
            'trail_stop_loss_calculation'   => ['nullable', 'bail'],
            'trail_stop_loss_step'   => ['nullable', 'bail'],
            'trail_stop_loss_step_calculation'   => ['nullable', 'bail'],
            'max_anti_martingale'   => ['nullable', 'bail'],
            'consecutive_stop_hits'   => ['nullable', 'bail'],
            'anti_martingale_multiplier'   => ['nullable', 'bail'],
            'reward_multiplier_method'   => ['nullable', 'bail'],
            'reward_multiplier_setting'   => ['nullable', 'bail'],
            'nearest_trade'   => ['nullable', 'bail'],
            'rounded_numbers_zero_digits'   => ['nullable', 'bail'],
            'rounded_numbers_max_distance'   => ['nullable', 'bail'],
            'max_daily_profit'   => ['nullable', 'bail'],
            'max_daily_profit_mode'   => ['nullable', 'bail'],
            'max_daily_profit_calculation'   => ['nullable', 'bail'],
            'max_daily_loss'   => ['nullable', 'bail'],
            'max_daily_loss_mode'   => ['nullable', 'bail'],
            'max_daily_loss_calculation'   => ['nullable', 'bail'],
            'equity_protector'   => ['nullable', 'bail'],
            'equity_protector_mode'   => ['nullable', 'bail'],
            'equity_protector_stop_out'   => ['nullable', 'bail'],
            'session_london'   => ['nullable', 'bail'],
            'session_london_start'   => ['nullable', 'bail'],
            'session_london_end'   => ['nullable', 'bail'],
            'session_new_york'   => ['nullable', 'bail'],
            'session_new_york_start'   => ['nullable', 'bail'],
            'session_new_york_end'   => ['nullable', 'bail'],
            'session_sydney'   => ['nullable', 'bail'],
            'session_sydney_start'   => ['nullable', 'bail'],
            'session_sydney_end'   => ['nullable', 'bail'],
            'session_tokyo'   => ['nullable', 'bail'],
            'session_tokyo_start'   => ['nullable', 'bail'],
            'session_tokyo_end'   => ['nullable', 'bail'],
            'session_frankfurt'   => ['nullable', 'bail'],
            'session_frankfurt_start'   => ['nullable', 'bail'],
            'news_trading'   => ['nullable', 'bail'],
            'news_trading_before'   => ['nullable', 'bail'],
            'news_trading_after'   => ['nullable', 'bail'],
            'news_trading_impact'   => ['nullable', 'bail'],
            'opposite_trading'   => ['nullable', 'bail'],
            'close_trades_on_weekend'   => ['nullable', 'bail'],
            'public'   => ['nullable', 'boolean'],
        ];
    }
}
