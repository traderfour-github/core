<?php

namespace App\Http\Controllers\V1\Post;

use App\Http\Controllers\V1\Controller;
use App\Http\Resources\V1\Post\PostSummaryResource;
use App\Http\Resources\V1\Tag\TagProductsResource;
use App\Http\Resources\V1\Tag\TagResource;
use App\Jobs\V1\Tag\GetPostsJob;
use App\Services\Tag\TagService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function __construct(
        private TagService $tagService
    ) {
    }

    public function get(Request $request)
    {
        $items = $this->tagService->tagList($request->only(['title']));

        return $this->respond(TagResource::collection($items));
    }

    public function read($id)
    {
        try {
            $data = $this->tagService->read($id);

            return $this->respond(new TagResource($data));
        } catch (ModelNotFoundException $exception) {
            return $this->respondEntityNotFound($exception);
        }
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
