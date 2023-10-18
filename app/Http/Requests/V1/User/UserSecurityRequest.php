<?php

namespace App\Http\Requests\V1\User;

use Illuminate\Foundation\Http\FormRequest;

class UserSecurityRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'anti_phishing'      => 'string|nullable',
            'google2fa_secret'   => 'boolean',
            'email_2step'        => 'array|nullable',
            'email_2step.*'      => 'email',
            'app_2step'          => 'array|nullable',
            'app_2step.*'        => 'mac_address',
            'mobile_2step'       => 'array|nullable',
            'mobile_2step.*'     => 'regex:/^(\+\d{1,3}[- ]?)?\d{10}$/',
            'same_wallet'        => 'boolean',
            'fund_password'      => 'string|nullable',
            'registered_wallets' => 'boolean',
            'delay'              => 'integer',
        ];
    }
}
