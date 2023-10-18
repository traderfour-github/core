<?php

namespace App\Http\Requests\V1\FinancialEngineering\TradingStrategy;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTradingStrategyRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
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
