<?php

namespace App\Http\Controllers\V1\My\License\License;

use App\Http\Controllers\V1\Controller;
use App\Http\Requests\V1\License\License\CreateRequest;
use App\Http\Requests\V1\License\License\UpdateRequest;
use App\Http\Resources\V1\License\License\IndexResource;
use App\Http\Resources\V1\License\License\SingleResource;
use App\Jobs\V1\License\License\DeleteJob;
use App\Jobs\V1\License\License\IndexJob;
use App\Jobs\V1\License\License\SingleJob;
use App\Jobs\V1\License\License\StoreJob;
use App\Jobs\V1\License\License\UpdateJob;
use App\Models\Trader4\V1\License\License;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LicenseController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        try {
            return $this->respond(
                IndexResource::collection(
                    dispatch_sync(new IndexJob($request->user()['uuid'], $request->only(License::REQUEST_GET_HANDLER)))
                )
            );
        } catch (\Exception $e) {
            return $this->exceptionHandler($e);
        }
    }

    public function show(Request $request, $id): JsonResponse
    {
        try {
            return $this->respond(
                SingleResource::make(dispatch_sync(new SingleJob($request->user()['uuid'], $id)))
            );
        } catch (Exception $exception) {
            return $this->respondWithError($exception);
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
            return $this->respond(
                SingleResource::make(dispatch_sync(new UpdateJob($request->user()['uuid'], $request->validated(), $id)))
            );
        } catch (Exception $exception) {
            return $this->respondWithError($exception);
        }
    }

    public function delete(Request $request, $id): JsonResponse
    {
        try {
            return $this->respondEntityRemoved(dispatch_sync(new DeleteJob($request->user()['uuid'], $id)));
        } catch (Exception $exception) {
            return $this->respondWithError($exception);
        }
    }
}
