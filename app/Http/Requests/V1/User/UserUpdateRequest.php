<?php

namespace App\Http\Requests\V1\User;

use App\Rules\CountryCodeRule;
use App\Rules\CurrencyCodeRule;
use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'first_name'  => ['nullable', 'string'],
            'middle_name' => ['nullable', 'string'],
            'last_name'   => ['nullable', 'string'],
            'country'     => ['nullable', new CountryCodeRule()],
            'language'    => ['nullable', 'string', 'max:5'],
            'timezone'    => ['nullable', 'timezone'],
            'currency'    => ['nullable', new CurrencyCodeRule()],
            'private'     => ['nullable', 'integer'],
            'avatar'      => ['nullable', 'string'],
        ];
    }
}
