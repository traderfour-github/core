<?php

namespace App\Http\Requests\V1\License\Licensable;

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
                'nullable',
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
            'license_id' => [
                'required',
                'bail',
                'string',
                Rule::exists('licenses', 'id'),
            ],
            'terminal_id' => [
                'nullable',
                'bail',
                'string',
                Rule::exists('terminals', 'id'),
            ],
            'trading_account_id' => [
                'nullable',
                'bail',
                'string',
                Rule::exists('trading_accounts', 'id'),
            ],
            'tag'               => ['nullable'],
            'key_type'          => ['nullable', 'integer'],
            'private_key'       => ['nullable', 'string'],
            'public_key'        => ['nullable','string'],
            'assigned_by'       => ['nullable','string'],
            'token_id'          => ['required', 'string','max:255','unique:licensables,token_id'],
            'token_secret'      => ['required', 'string','max:255','unique:licensables,token_secret'],
            'setting'           => ['nullable', 'array'],
            'installed_at'      => ['nullable','string' , 'date_format:Y-m-d H:i:s'],
            'activated_at'      => ['nullable','string' , 'date_format:Y-m-d H:i:s'],
            'deactivated_at'    => ['nullable','string' , 'date_format:Y-m-d H:i:s'],
            'suspended_at'      => ['nullable','string' , 'date_format:Y-m-d H:i:s'],
            'resumed_at'        => ['nullable','string' , 'date_format:Y-m-d H:i:s'],
            'expires_at'        => ['nullable','string' , 'date_format:Y-m-d H:i:s'],
            'status'            => ['nullable','integer'],
        ];
    }
}
