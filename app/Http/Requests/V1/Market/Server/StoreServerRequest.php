<?php

namespace App\Http\Requests\V1\Market\Server;

use App\Enums\V1\Market\Server\ServerIPType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreServerRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'platform_id' => ['required', 'exists:platforms,id'],
            'address' => ['required', 'string', 'max:255'],
            'ip_type' => ['required', 'integer', Rule::in(ServerIPType::toArray())],
            'port' => ['required', 'integer'],
            'is_public' => ['required', 'boolean'],
        ];
    }
}
