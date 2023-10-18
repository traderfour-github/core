<?php

namespace App\Http\Requests\V1\License\License;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'post_id' => [
                'required',
                'bail',
                'string',
                Rule::exists('posts', 'id'),
            ],
            'version_id' => [
                'nullable',
                'bail',
                'string',
                Rule::exists('versions', 'id'),
            ],
            'key_type'          => ['nullable', 'integer'],
            'private_key'       => ['nullable', 'string'],
            'public_key'        => ['nullable','string'],
            'max_terminals'     => ['nullable','integer'],
            'max_accounts'      => ['nullable', 'integer'],
            'allowed_markets'   => ['nullable', 'array'],
            'allowed_brokers'   => ['nullable', 'array'],
            'allowed_countries' => ['nullable', 'array'],
            'is_real'           => ['nullable','boolean'],
            'max_balance'       => ['nullable', 'integer'],
            'max_equity'        => ['nullable', 'integer'],
            'max_volume'        => ['nullable','integer'],
            'max_orders'        => ['nullable','integer'],
            'max_symbols'       => ['nullable','integer'],
            'max_timeframes'    => ['nullable', 'integer'],
            'is_lifetime'       => ['nullable', 'boolean'],
            'is_trial'          => ['nullable', 'boolean'],
            'status'            => ['nullable','integer'],
        ];
    }
}
