<?php

namespace App\Http\Resources\V1\Category;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class CategoryResource extends JsonResource
{

    public function toArray($request): array
    {
        return [
            'uuid'         => $this->id,
            'title'        => $this->title,
            'slug'         => $this->slug,
            'icon'         => $this->getTemporaryUrl($this->icon),
            'type'         => $this->type,
        ];
    }

    public function getTemporaryUrl(?string $path): string | null
    {
        if ($path!=null) return Storage::disk('s3')->temporaryUrl($path, now()->addMinutes(10));
        return null;
    }
}
