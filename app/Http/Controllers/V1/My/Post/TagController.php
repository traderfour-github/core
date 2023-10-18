<?php

namespace App\Http\Controllers\V1\My\Post;

use App\Http\Controllers\V1\Controller;
use App\Http\Resources\V1\Tag\TagProductsResource;
use App\Http\Resources\V1\Tag\TagResource;
use App\Services\Tag\TagService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
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

    public function products($uuid)
    {
        $products = $this->tagService->products($uuid);

        return $this->respond(TagProductsResource::collection($products));
    }
}
