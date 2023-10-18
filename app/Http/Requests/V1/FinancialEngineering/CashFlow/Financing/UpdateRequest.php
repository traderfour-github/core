<?php

namespace App\Http\Requests\V1\FinancialEngineering\CashFlow\Financing;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title'  => ['nullable', 'string', 'max:255'],
            'amount' => ['nullable', 'integer'],
            'from'   => ['nullable', 'date_format:Y-m-d'],
            'till'   => ['nullable', 'date_format:Y-m-d'],
            'is_public'    => ['nullable', 'boolean'],
        ];
    }
}
