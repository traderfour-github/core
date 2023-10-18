<?php

namespace App\Http\Requests\V1\FinancialEngineering\Entry;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateEntryRequest extends FormRequest
{


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'trading_strategy_id' => ['required', 'bail', 'string', Rule::exists('trading_strategies', 'id')],
            'title' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'order_type' => ['integer'],
            'source' => ['integer'],
            'source_type' => ['integer'],
            'source_settings' => ['nullable', 'array'],
            'comparison' => ['integer'],
            'trigger' => ['nullable', 'string'],
            'is_required' => ['boolean'],
            'time_frame' => ['integer'],
            'data_feed' => ['nullable', 'string']
        ];
    }
}
