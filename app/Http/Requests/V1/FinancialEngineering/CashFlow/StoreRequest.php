<?php

namespace App\Http\Requests\V1\FinancialEngineering\CashFlow;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'market_id'          => ['nullable', 'string', Rule::exists('markets', 'id')],
            'trading_account_id' => ['required', 'string', Rule::exists('trading_accounts', 'id')],
            'title'              => ['nullable', 'string', 'max:255'],
            'description'        => ['nullable', 'string'],
            'public'             => ['nullable', 'boolean'],
            'till'               => ['nullable', 'date_format:Y-m-d'],
            'from'               => ['nullable', 'date_format:Y-m-d'],
        ];
    }
}
