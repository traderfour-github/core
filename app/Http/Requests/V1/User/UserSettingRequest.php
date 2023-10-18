<?php

namespace App\Http\Requests\V1\User;

use App\Enums\UserSetting\AutoWithdraw;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class UserSettingRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'daily_report' => ['nullable', 'date_format:H:i'],
            'auto_renewal' => 'boolean',
            'auto_withdraw' => ['nullable', new Enum(AutoWithdraw::class)],
        ];
    }
}
