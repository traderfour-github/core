<?php

namespace App\Http\Resources\V1\Category;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryProductsResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'uuid'           => $this->id,
            'title'          => $this->title,
            'slogan'         => $this->slogan,
            'logo'           => $this->logo,
            'cover'          => $this->cover,
            'download_count' => $this->download_count,
            'view_count'     => $this->view_count,
            'purchase_count' => $this->purchase_count,
            'comment_count'  => $this->comment_count,
            'type'           => $this->type,
            'status'         => $this->status,
            'published_at'   => $this->published_at,
            'last_update'    => $this->last_update,
        ];
    }
}
