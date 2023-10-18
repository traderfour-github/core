<?php

namespace App\Http\Requests\V1\FinancialEngineering\MoneyManagement;

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
            'title'                       => ['nullable', 'string','max:255'],
            'position_size'               => ['nullable', 'string','max:255'],
            'position_size_mode'          => ['nullable', 'integer'],
            'position_size_calculation'   => ['nullable', 'integer'],
            'maximum_size'                => ['nullable', 'integer'],
            'minimum_size'                => ['nullable', 'integer'],
        ];
    }
}
