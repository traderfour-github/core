<?php

namespace App\Http\Controllers\V1\My\License\Version;

use App\Http\Controllers\V1\Controller;
use App\Http\Requests\V1\License\Version\CreateRequest;
use App\Http\Requests\V1\License\Version\UpdateRequest;
use App\Http\Resources\V1\License\Version\IndexResource;
use App\Http\Resources\V1\License\Version\SingleResource;
use App\Jobs\V1\License\Version\DeleteJob;
use App\Jobs\V1\License\Version\IndexJob;
use App\Jobs\V1\License\Version\SingleJob;
use App\Jobs\V1\License\Version\StoreJob;
use App\Jobs\V1\License\Version\UpdateJob;
use App\Models\Trader4\V1\License\Version;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class VersionController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        try {
            return $this->respond(
                IndexResource::collection(dispatch_sync(new IndexJob($request->user()['uuid'], $request->only(Version::REQUEST_GET_HANDLER))))
            );
        } catch (\Exception $e) {
            return $this->exceptionHandler($e);
        }
    }

    public function show(Request $request, $uuid): JsonResponse
    {
        try {
            return $this->respond(
                SingleResource::make(dispatch_sync(new SingleJob($request->user()['uuid'], $uuid)))
            );
        }catch (\Exception $e) {
            return $this->respondWithError($e);
        }
    }

    public function store(CreateRequest $request): JsonResponse
    {
        try{
            return $this->respond(
                SingleResource::make(
                    dispatch_sync(new StoreJob($request->user()['uuid'], $request->validated()))
                )
            );
        }catch (\Exception $e) {
            return $this->respondWithError($e);
        }
    }

    public function update(UpdateRequest $request, $id): JsonResponse
    {
        try {
            return $this->respond(SingleResource::make(
                dispatch_sync(new UpdateJob($request->user()['uuid'], $request->validated(), $id)))
            );
        } catch (\Exception $exception) {
            return $this->respondWithError($exception);
        }
    }

    public function delete(Request $request, $id): JsonResponse
    {
        try {
            return $this->respondEntityRemoved(
                dispatch_sync(new DeleteJob($request->user()['uuid'], $id))
            );
        } catch (\Exception $exception) {
            return $this->respondWithError($exception);
        }
    }
}
