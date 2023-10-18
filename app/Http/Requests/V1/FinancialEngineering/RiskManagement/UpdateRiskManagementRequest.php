<?php

namespace App\Http\Requests\V1\FinancialEngineering\RiskManagement;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRiskManagementRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => ['nullable', 'string', 'max:255'],
            'max_risk' => ['nullable', 'string', 'max:255'],
            'max_risk_mode' => ['nullable', 'integer'],
            'max_risk_calculation' => ['nullable', 'integer'],
            'max_daily_risk' => ['nullable', 'integer'],
            'max_daily_risk_mode' => ['nullable', 'integer'],
            'max_daily_risk_calculation' => ['nullable', 'integer'],
            'risk_per_chart' => ['nullable', 'string', 'max:255'],
            'risk_per_chart_mode' => ['nullable', 'integer'],
            'risk_per_chart_calculation' => ['nullable', 'integer'],
            'risk_per_trade' => ['nullable', 'string', 'max:255'],
            'risk_per_trade_mode' => ['nullable', 'integer'],
            'risk_per_trade_calculation' => ['nullable', 'integer'],
            'risk_reward_ratio' => ['nullable', 'integer'],
            'public' => ['nullable', 'boolean'],
        ];
    }
}
