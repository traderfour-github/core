<?php

namespace App\Http\Requests\V1\FinancialEngineering\MoneyManagement;

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
//            'trading_account_id'          => ['required', 'string', Rule::exists('trading_accounts', 'id')],
            'instrument_id'               => ['nullable', 'string', Rule::exists('instruments', 'id')],
            'title'                       => ['nullable', 'string','max:255'],
            'position_size'               => ['nullable', 'string','max:255'],
            'position_size_mode'          => ['nullable', 'integer'],
            'position_size_calculation'   => ['nullable', 'integer'],
            'maximum_size'                => ['nullable', 'integer'],
            'minimum_size'                => ['nullable', 'integer'],
        ];
    }
}
