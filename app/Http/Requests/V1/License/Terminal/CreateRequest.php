<?php

namespace App\Http\Requests\V1\License\Terminal;

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
            'trading_account_id' => [
                'required',
                'bail',
                'string',
                Rule::exists('trading_accounts', 'id'),
            ],
            'assigned_by'   => ['nullable', 'string'],
            'bulut_id'      => ['nullable', 'string'],
            'ip_address'    => ['nullable', 'ip'],
            'mac_address'   => ['nullable', 'string', 'max:255'],
            'name'          => ['nullable', 'string', 'max:255'],
            'version'       => ['nullable', 'string', 'max:255'],
            'build'         => ['nullable', 'string', 'max:255'],
            'path'          => ['nullable', 'string', 'max:255'],
            'language'      => ['nullable', 'string', 'max:255'],
            'country'       => ['nullable', 'string', 'max:255'],
            'timezone'      => ['nullable', 'string', 'max:255'],
            'installed_at'  => ['nullable','string' , 'date_format:Y-m-d H:i:s'],
            'last_seen'     => ['nullable','string' , 'date_format:Y-m-d H:i:s'],
            'status'        => ['nullable','integer'],
        ];
    }
}
