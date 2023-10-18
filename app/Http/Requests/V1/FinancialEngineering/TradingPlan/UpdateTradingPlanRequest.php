<?php

namespace App\Http\Requests\V1\FinancialEngineering\TradingPlan;

use App\Rules\StringAsArrayRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateTradingPlanRequest extends FormRequest
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
            'instruments' => ['nullable', 'string', new StringAsArrayRule()],
            'daily_start' => ['nullable', 'date_format:Y-m-d'],
            'daily_finish' => ['nullable', 'date_format:Y-m-d'],
            'daily_finish_exit' => ['boolean'],
            'max_daily_trades' => ['integer'],
            'public' => ['boolean'],
        ];
    }
}
