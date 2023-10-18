<?php

namespace App\Http\Requests\V1\FinancialEngineering\CashFlow\Investing;

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
            'cash_flow_id' => [
                'required',
                'string',
                Rule::exists('cash_flows', 'id')->where('user_id', $this->user()['uuid']),
            ],
            'parent_id'    => ['nullable', 'string', Rule::exists('cash_flow_investing', 'id')],
            'title'        => ['nullable', 'string', 'max:255'],
            'amount'       => ['nullable', 'integer'],
            'from'         => ['nullable', 'date_format:Y-m-d'],
            'till'         => ['nullable', 'date_format:Y-m-d'],
            'is_public'    => ['nullable', 'boolean'],
        ];
    }
}
