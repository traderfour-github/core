<?php

namespace App\Http\Requests\V1\User;

use Illuminate\Foundation\Http\FormRequest;

class UserNotificationSettingRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'profit_email'      => 'boolean',
            'profit_push'       => 'boolean',
            'withdraw_email'    => 'boolean',
            'withdraw_push'     => 'boolean',
            'deposit_email'     => 'boolean',
            'deposit_push'      => 'boolean',
            'wallet_email'      => 'boolean',
            'wallet_push'       => 'boolean',
            'support_email'     => 'boolean',
            'support_push'      => 'boolean',
            'transaction_email' => 'boolean',
            'transaction_push'  => 'boolean',
            'marketing_email'   => 'boolean',
            'marketing_push'    => 'boolean'
        ];
    }
}
