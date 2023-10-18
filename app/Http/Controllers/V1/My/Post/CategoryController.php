<?php

namespace App\Http\Controllers\V1\My\Post;

use App\Http\Controllers\V1\Controller;
use App\Http\Resources\V1\Category\CategoryProductsResource;
use App\Http\Resources\V1\Category\CategoryResource;
use App\Services\Category\CategoryService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct(
        private CategoryService $categoryService
    ) {
    }

    public function get(Request $request)
    {
        $items = $this->categoryService->categoryList($request->only(['title', 'type']));

        return $this->respond(CategoryResource::collection($items));
    }

    public function children(string $uuid): JsonResponse
    {
        $children = $this->categoryService->children($uuid);
        return $this->respond(CategoryResource::collection($children));
    }

    public function products(string $uuid): JsonResponse
    {
        $products = $this->categoryService->products($uuid);
        return $this->respond(CategoryProductsResource::collection($products));
    }
}
