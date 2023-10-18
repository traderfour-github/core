<?php

namespace App\Services\Tag;

use App\Repositories\V1\TagRepository;

class TagService
{
    public function __construct(private TagRepository $tagRepository) {
    }

    public function tagList(array $data)
    {
        return $this->tagRepository->tagList($data);
    }

    public function read(string $uuid)
    {
        return $this->tagRepository->tagDetail($uuid);
    }

    public function products(string $uuid)
    {
        return $this->tagRepository->products($uuid);
    }

}
