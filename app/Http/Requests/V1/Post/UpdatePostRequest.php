<?php

namespace App\Http\Requests\V1\Post;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class UpdatePostRequest extends FormRequest
{
    protected function prepareForValidation()
    {
        $this->merge([
            'slogan' => Str::slug($this->slogan ?? null),
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title'    => ['required', 'string'],
            'slogan'   => ['required', 'string', $this->uniqueSlogan()],
            'logo_id'       => [
                'nullable',
                'string',
                Rule::exists('attachments', 'id')->where('user_id', $this->user()['uuid']),
            ],
            'cover_id'      => [
                'nullable',
                'string',
                Rule::exists('attachments', 'id')->where('user_id', $this->user()['uuid']),
            ],
            'excerpt'  => ['required', 'string'],
            'content'  => ['required', 'string'],
        ];
    }

    private function uniqueSlogan()
    {
        return Rule::unique('posts', 'slogan')->ignore($this->route('uuid'), 'id');
    }
}
