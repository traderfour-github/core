<?php

namespace App\Http\Controllers\V1\My\Post;

use App\Http\Controllers\V1\Controller;
use App\Http\Requests\V1\Post\CreatePostRequest;
use App\Http\Requests\V1\Post\UpdatePostRequest;
use App\Http\Resources\V1\Post\MyPostResource;
use App\Http\Resources\V1\Post\PostListResource;
use App\Jobs\V1\Post\My\PostCreateJob;
use App\Jobs\V1\Post\My\PostDeleteJob;
use App\Jobs\V1\Post\My\PostIndexJob;
use App\Jobs\V1\Post\My\PostShowJob;
use App\Jobs\V1\Post\My\PostUpdateJob;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        try {
            return $this->respond(PostListResource::collection(dispatch_sync(new PostIndexJob(
                $request->user()['uuid'],
                $request->only(['title', 'slogan', 'type', 'published_at', 'status', 'sort'])
            ))));
        } catch (\Exception $e) {
            return $this->exceptionHandler($e);
        }
    }

    public function show(string $uuid, Request $request): JsonResponse
    {
        try {
            return $this->respond(MyPostResource::make(dispatch_sync(new PostShowJob($request->user()['uuid'], $uuid))));
        } catch (\Exception $e) {
            return $this->exceptionHandler($e);
        }
    }

    public function store(CreatePostRequest $request): JsonResponse
    {
        try {
            // todo: replace with respondEntityCreated
            return $this->setCreatedMessage()->respond(MyPostResource::make(dispatch_sync(new PostCreateJob($request))));
        } catch (\Exception $e) {
            return $this->exceptionHandler($e);
        }
    }

    public function update(UpdatePostRequest $request): JsonResponse
    {
        try {
            return $this->setUpdatedMessage()->respond(MyPostResource::make(dispatch_sync(new PostUpdateJob($request))));
        } catch (\Exception $e) {
            return $this->exceptionHandler($e);
        }
    }

    public function delete(Request $request) : JsonResponse
    {
        // TODO: check if product has subscription or sold cannot be deleted
        if(false){
            return $this->respondWithError(false);
        }

        try {
            return $this->respondEntityRemoved(dispatch_sync(new PostDeleteJob($request)));
        } catch (\Exception $e) {
            return $this->exceptionHandler($e);
        }
    }
}
