<?php

namespace App\Http\Resources\V1\Account\Attachment;

use App\Jobs\V1\My\Account\Attachment\GetAttachmentLinkJob;
use Illuminate\Http\Resources\Json\JsonResource;

class AttachmentSummaryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'link' => dispatch_sync(new GetAttachmentLinkJob($this->path)),
            'type' => $this->type,
        ];
    }
}
