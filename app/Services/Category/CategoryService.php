<?php

namespace App\Services\Category;

use App\Repositories\V1\CategoryRepository;

class CategoryService
{

    public function __construct(private CategoryRepository $categoryRepository) {
    }

    public function categoryList(array $data)
    {
        return $this->categoryRepository->categoryList($data);
    }

//    public function read(string $uuid)
//    {
//        return $this->categoryRepository->categoryDetail($uuid);
//    }


    public function children(string $uuid)
    {
        return $this->categoryRepository->children($uuid);
    }

    public function products(string $uuid)
    {
        return $this->categoryRepository->products($uuid);
    }

}
