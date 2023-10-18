<?php

namespace App\Http\Requests\V1\License\Version;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
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
            'platform_id' => [
                'required',
                'bail',
                'string',
                Rule::exists('platforms', 'id'),
            ],
            'title'         => ['required', 'string', 'max:255'],
            'signature'     => ['required', 'string', 'max:255','unique:versions,signature,'.$this->uuid],
            'file'           => ['nullable', 'string'],
            'user_manual'   => ['nullable', 'string', 'max:255'],
            'change_log'    => ['nullable', 'array'],
            'update_type'   => ['nullable','integer'],
            'major'         => ['required','integer'],
            'minor'         => ['required','integer'],
            'patch'         => ['required','integer'],
            'force'         => ['nullable', 'boolean'],
            'downloads'     => ['nullable','integer'],
            'requests'      => ['nullable','integer'],
            'last_update'   => ['nullable','string' , 'date_format:Y-m-d H:i:s'],
            'published_at'  => ['nullable','string' , 'date_format:Y-m-d H:i:s'],
            'status'        => ['nullable','integer'],
        ];
    }
}
