<?php

namespace App\Http\Requests\V1\Trading\Account;

use App\Rules\StringAsArrayRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name'             => ['nullable', 'string', 'max:255'],
            'broker_id'        => ['nullable', 'bail', 'string', Rule::exists('brokers', 'id')],
            'platforms'        => ['required', 'string', new StringAsArrayRule],
            'tags'             => ['required', 'string', new StringAsArrayRule],
            'server_id'        => ['nullable', 'bail', 'string', Rule::exists('servers', 'id')],
            'identity'         => ['nullable', 'string', 'max:255'],
            'secret'           => ['nullable', 'string', 'max:255'],
            'secret_read_only' => ['nullable', 'string', 'max:255'],
            'company'          => ['nullable', 'string', 'max:255'],
            'trade_mode'       => ['nullable', 'integer'],
            'margin_type'      => ['nullable', 'integer'],
            'order_limit'      => ['nullable', 'integer'],
            'trade_allowed'    => ['nullable', 'boolean'],
            'hedge'            => ['nullable', 'boolean'],
            'capital_road'     => ['nullable', 'boolean'],
            'currency'         => ['nullable', 'string', 'max:3'],
            'leverage'         => ['nullable', 'integer'],
            'stopout_level'    => ['nullable', 'integer'],
            'balance'          => ['nullable', 'string', 'max:255'],
            'credit'           => ['nullable', 'string', 'max:255'],
            'equity'           => ['nullable', 'string', 'max:255'],
            'margin'           => ['nullable', 'string', 'max:255'],
            'free_margin'      => ['nullable', 'string', 'max:255'],
            'margin_level'     => ['nullable', 'string', 'max:255'],
            'report'           => ['nullable', 'integer'],
            'is_funded'        => ['nullable', 'boolean'],
            'is_public'        => ['nullable', 'boolean'],
            'status'           => ['nullable', 'integer'],
        ];
    }
}
