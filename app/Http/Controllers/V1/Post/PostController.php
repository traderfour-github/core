<?php

namespace App\Http\Controllers\V1\Post;

use App\Http\Controllers\V1\Controller;
use App\Http\Resources\V1\Post\PostListResource;
use App\Http\Resources\V1\Post\PostResource;
use App\Jobs\V1\Post\GetRelatedJob;
use App\Jobs\V1\Post\IndexJob;
use App\Jobs\V1\Post\ShowJob;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        try{
            return $this->respond(PostListResource::collection(dispatch_sync(new IndexJob($request->only(['owner','title' , 'slogan','published_at', 'type', 'status', 'sort'])))));
        }catch (\Exception $e){
            return $this->exceptionHandler($e);
        }
    }

    public function show(string $slogan): JsonResponse
    {
        try {
            return $this->respond(PostResource::make(dispatch_sync(new ShowJob($slogan))));
        } catch (\Exception $e) {
            return $this->exceptionHandler($e);
        }
    }

    public function related($uuid): JsonResponse
    {
        try {
            return $this->respond(PostListResource::collection(dispatch_sync(new GetRelatedJob($uuid))));
        } catch (\Exception $e) {
            return $this->exceptionHandler($e);
        }
    }
}
