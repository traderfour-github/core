<?php

namespace App\Http\Requests\V1\FinancialEngineering\ExitStrategy;

use Illuminate\Foundation\Http\FormRequest;

class UpdateExitStrategyRequest extends FormRequest
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
            'description' => ['nullable', 'string'],
            'order_type' => ['integer'],
            'source' => ['integer'],
            'source_type' => ['integer'],
            'source_settings' => ['nullable', 'array'],
            'comparison' => ['integer'],
            'trigger' => ['nullable', 'string'],
            'is_required' => ['boolean'],
            'time_frame' => ['integer'],
            'data_feed' => ['nullable', 'string'],
        ];
    }
}
