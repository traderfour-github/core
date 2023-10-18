<?php

namespace App\Http\Resources\V1\Post;

use App\Http\Resources\V1\Account\Attachment\AttachmentSummaryResource;
use App\Http\Resources\V1\Category\CategoryResource;
use App\Http\Resources\V1\Market\Platform\PlatformSummeryResource;
use App\Http\Resources\V1\Tag\TagResource;
use App\Jobs\V1\GetGeneralImageLinkJob;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{

    public function toArray($request): array
    {
        return [
            'uuid'           => $this->id,
            'title'          => $this->title,
            'slogan'         => $this->slogan,
            'excerpt'        => $this->excerpt,
            'content'        => $this->is_public ? $this->content : null,
            'logo'           => isset($this->logo_id) ? dispatch_sync(new GetGeneralImageLinkJob($this->logo->path)) : null,
            'cover'          => isset($this->cover_id) ? dispatch_sync(new GetGeneralImageLinkJob($this->cover->path)) : null,
            'download_count' => $this->download_count,
            'view_count'     => $this->view_count,
            'purchase_count' => $this->purchase_count,
            'comment_count'  => $this->comment_count,
            'comments'       => $this->comments,
            'type'           => $this->type,
            'is_public'      => $this->is_public,
            'status'         => $this->status,
            'published_at'   => $this->published_at,
            'last_update'    => $this->last_update,
            'tags'           => TagResource::collection($this->tags),
            'categories'     => CategoryResource::collection($this->categories),
            'platforms'      => PlatformSummeryResource::collection($this->platforms),
            'attachments'    => $this->is_public ? AttachmentSummaryResource::collection($this->attachments) : [],
        ];
    }
}
