<?php

namespace App\Http\Controllers\V1\FinancialEngineering\Entry;

use App\Http\Controllers\V1\Controller;
use App\Http\Requests\V1\FinancialEngineering\Entry\CreateEntryRequest;
use App\Http\Requests\V1\FinancialEngineering\Entry\UpdateEntryRequest;
use App\Http\Resources\V1\FinancialEngineering\Entry\EntryListResource;
use App\Http\Resources\V1\FinancialEngineering\Entry\EntryResource;
use App\Jobs\V1\FinancialEngineering\Entry\DeleteJob;
use App\Jobs\V1\FinancialEngineering\Entry\IndexJob;
use App\Jobs\V1\FinancialEngineering\Entry\SingleJob;
use App\Jobs\V1\FinancialEngineering\Entry\StoreJob;
use App\Jobs\V1\FinancialEngineering\Entry\UpdateJob;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class EntryStrategyController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        try {
            return $this->respond(EntryListResource::collection(dispatch_sync(new IndexJob($request->user()['uuid'], $request->only([])))));
        } catch (Exception $exception) {
            return $this->respondWithError($exception);
        }
    }

    public function show(Request $request, $id): JsonResponse
    {
        try {
            return $this->respond(EntryResource::make(dispatch_sync(new SingleJob($request->user()['uuid'], $id))));
        } catch (Exception $exception) {
            return $this->respondWithError($exception);
        }
    }

    public function store(CreateEntryRequest $request): JsonResponse
    {
        try {
            return $this->respond(EntryResource::make(dispatch_sync(new StoreJob($request->user()['uuid'], $request->validated()))));
        } catch (Exception $exception) {
            return $this->respondWithError($exception);
        }
    }

    public function update(UpdateEntryRequest $request, $id): JsonResponse
    {
        try {
            return $this->respond(EntryResource::make(dispatch_sync(new UpdateJob($request->user()['uuid'], $request->validated(), $id))));
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
