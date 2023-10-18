<?php

namespace App\Http\Requests\V1\Account\Attachment;

use App\Enums\V1\User\Attachment\Type;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateAttachmentRequest extends FormRequest
{
    protected $stopOnFirstFailure = true;

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        // todo: move mimetypes to App\Enums\V1\User\Attachment\MimesType::class
        $mimes = [
            Type::IMAGE->value => 'png,jpg,jpeg',
            Type::DOCUMENT->value => 'zip,rar',
        ];

        return [
            'type' => ['required', 'integer', Rule::in(Type::toArray())],
            'file' => ['required', 'file', 'mimes:'.$mimes[$this->type], 'max:'.config('trader4.attachments.max_size')],
        ];
    }
}
