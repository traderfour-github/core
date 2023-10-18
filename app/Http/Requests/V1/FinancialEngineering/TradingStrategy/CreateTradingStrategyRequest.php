<?php

namespace App\Http\Requests\V1\FinancialEngineering\TradingStrategy;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateTradingStrategyRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'market_id' => ['nullable', 'string', Rule::exists('markets', 'id')],
            'trading_account_id' => ['required', 'string', Rule::exists('trading_accounts', 'id')],
            'risk_management_id' => ['nullable', 'string', Rule::exists('risk_managements', 'id')],
            'trading_plan_id' => ['nullable', 'string', Rule::exists('trading_plans', 'id')],
            'money_management_id' => ['nullable', 'string', Rule::exists('money_managements', 'id')],
            'title' => ['nullable', 'string', 'max:255'],
            'time_frame' => ['required', 'integer'],
            'exit_on_friday' => ['nullable', 'date_format:Y-m-d'],
            'exit_end_of_day' => ['nullable', 'date_format:Y-m-d'],
            'minimum_stop_loss' => ['nullable', 'string', 'max:255'],
            'maximum_stop_loss' => ['nullable', 'string', 'max:255'],
            'minimum_target_price' => ['nullable', 'string', 'max:255'],
            'maximum_target_price' => ['nullable', 'string', 'max:255'],
            'maximum_spread' => ['nullable', 'string', 'max:255'],
            'maximum_slippage' => ['nullable', 'string', 'max:255'],
            'entry_triggers_count' => ['nullable', 'integer'],
            'exit_triggers_count' => ['nullable', 'integer'],
            'public' => ['nullable', 'boolean'],
        ];
    }
}
