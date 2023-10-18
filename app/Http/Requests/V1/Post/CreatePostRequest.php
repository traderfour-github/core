<?php

namespace App\Http\Requests\V1\Post;

use App\Enums\V1\Post\Comment;
use App\Enums\V1\Post\Type;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class CreatePostRequest extends FormRequest
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
            'title'         => ['required', 'string'],
            'slogan'        => ['nullable', 'string', 'unique:posts,slogan'],
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
            'excerpt'       => ['nullable', 'string'],
            'content'       => ['required', 'string'],
            'comments'      => ['nullable', 'integer', Rule::in(Comment::toArray())],
            'type'          => ['nullable', 'integer', Rule::in(Type::toArray())],
            'is_public'     => ['nullable', 'boolean'],
            'attachments'   => ['nullable', 'array'],
            'attachments.*' => [
                'required',
                'string',
                Rule::exists('attachments', 'id')->where('user_id', $this->user()['uuid']),
            ],
            'categories'    => ['nullable', 'array'],
            'categories.*'  => ['required', 'string'],
            'tags'          => ['nullable', 'array'],
            'tags.*'        => ['required', 'string'],
            'markets'       => ['nullable', 'array'],
            'markets.*'     => ['required', 'string', 'exists:markets,id'],
            'platforms'     => ['nullable', 'array'],
            'platforms.*'   => ['required', 'string', 'exists:platforms,id'],
            // 'licenses'    => ['nullable', 'array'],
            // 'licenses.*'  => ['required', 'string', 'exists:licenses,id'],
        ];
    }
}
