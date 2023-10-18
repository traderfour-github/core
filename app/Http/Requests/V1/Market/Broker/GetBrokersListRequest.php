<?php

namespace App\Http\Requests\V1\Market\Broker;

use App\Models\Trader4\V1\Market\Broker;
use Illuminate\Foundation\Http\FormRequest;

class GetBrokersListRequest extends FormRequest
{
    public function rules(): array
    {
        $rules['sort'] = ['sometimes', 'required', 'array'];
        $rules['market'] = ['sometimes', 'required', 'string'];
        $rules['platform'] = ['sometimes', 'required', 'string'];
        $rules['server'] = ['sometimes', 'required', 'string'];
        $rules['instrument'] = ['sometimes', 'required', 'string'];

        foreach (Broker::$booleanFields as $field) {
            $rules[$field] = ['sometimes', 'required', 'boolean'];
        }

        foreach (Broker::$jsonFields as $field) {
            $rules[$field] = ['sometimes', 'required', 'array'];
        }

        foreach (Broker::$stringFields as $field) {
            $rules[$field] = ['sometimes', 'required', 'string'];
        }

        foreach (Broker::$integerFields as $field) {
            $rules[$field] = ['sometimes', 'required', 'integer'];
        }

        return $rules;
    }
}
