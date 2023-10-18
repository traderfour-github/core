<?php

namespace App\Http\Controllers\V1\My\Trading\Framework;

use App\Http\Controllers\V1\Controller;
use App\Http\Requests\V1\Trading\Framework\CreateRequest;
use App\Http\Requests\V1\Trading\Framework\UpdateRequest;
use App\Http\Resources\V1\Trading\Framework\IndexResource;
use App\Http\Resources\V1\Trading\Framework\SingleResource;
use App\Jobs\V1\My\Trading\Framework\GetJob;
use App\Jobs\V1\My\Trading\Framework\CreateJob;
use App\Jobs\V1\My\Trading\Framework\DeleteJob;
use App\Jobs\V1\My\Trading\Framework\ReadJob;
use App\Jobs\V1\My\Trading\Framework\UpdateJob;
use App\Models\Trader4\V1\Trading\Framework;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FrameworkController extends Controller
{
    public function __construct(){}

    public function index(Request $request): JsonResponse
    {
        try {
            return $this->respond(
                IndexResource::collection(dispatch_sync(new GetJob($request->user()['uuid'], $request->only(Framework::REQUEST_GET_HANDLER))))
            );
        } catch (\Exception $e) {
            return $this->exceptionHandler($e);
        }
    }

    public function show(Request $request, $uuid): JsonResponse
    {
        try {
            return $this->respond(
                SingleResource::make(dispatch_sync(new ReadJob($request->user()['uuid'], $uuid)))
            );
        }catch (\Exception $e) {
            return $this->respondWithError($e);
        }
    }

    public function store(CreateRequest $request) : JsonResponse
    {
        try{
            return $this->respond(
                SingleResource::make(
                    dispatch_sync(new CreateJob($request->user()['uuid'], $request->validated()))
                )
            );
        }catch (\Exception $e) {
            return $this->respondWithError($e);
        }
    }

    public function update(UpdateRequest $request, $uuid): JsonResponse
    {
        try{
            return $this->respond(
                SingleResource::make(
                    dispatch_sync(new UpdateJob($uuid, $request->validated()))
                )
            );
        }catch (\Exception $e) {
            return $this->respondWithError($e);
        }
    }

    public function delete($uuid): JsonResponse
    {
        try{
            return $this->respondEntityRemoved(dispatch_sync(new DeleteJob($uuid)));
        }catch (\Exception $e) {
            return $this->respondWithError($e);
        }
    }
}
