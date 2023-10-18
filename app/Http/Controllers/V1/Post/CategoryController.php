<?php

namespace App\Http\Controllers\V1\Post;

use App\Http\Controllers\V1\Controller;
use App\Http\Resources\V1\Category\CategoryResource;
use App\Http\Resources\V1\Post\PostSummaryResource;
use App\Jobs\V1\Category\GetPostsJob;
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

    public function posts(string $uuid): JsonResponse
    {
        try{
            return $this->respond(PostSummaryResource::collection(dispatch_sync(new GetPostsJob($uuid))));
        }catch (\Exception $e){
            return $this->exceptionHandler($e);
        }
    }
}
