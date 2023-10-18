<?php

namespace App\Http\Controllers\V1\FinancialEngineering\MoneyManagement;

use App\Http\Controllers\V1\Controller;
use App\Http\Requests\V1\FinancialEngineering\MoneyManagement\StoreRequest;
use App\Http\Requests\V1\FinancialEngineering\MoneyManagement\UpdateRequest;
use App\Http\Resources\V1\FinancialEngineering\MoneyManagement\MoneyManagementListResource;
use App\Http\Resources\V1\FinancialEngineering\MoneyManagement\MoneyManagementResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Jobs\V1\FinancialEngineering\MoneyManagement\IndexJob;
use App\Jobs\V1\FinancialEngineering\MoneyManagement\StoreJob;
use App\Jobs\V1\FinancialEngineering\MoneyManagement\showJob;
use App\Jobs\V1\FinancialEngineering\MoneyManagement\UpdateJob;
use App\Jobs\V1\FinancialEngineering\MoneyManagement\DeleteJob;

class MoneyManagementController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        try {
            return $this->respond(MoneyManagementListResource::collection(dispatch_sync(new IndexJob($request->user()['uuid'], $request->only([])))));
        } catch (\Exception $exception) {
            return $this->respondWithError($exception);
        }
    }

    public function store(StoreRequest $request): JsonResponse
    {
        try {
            return $this->respond(MoneyManagementResource::make(dispatch_sync(new StoreJob($request->user()['uuid'], $request->validated()))));
        } catch (\Exception $exception) {
            return $this->respondWithError($exception);
        }
    }

    public function show(Request $request, $uuid): JsonResponse
    {
        try {
            return $this->respond(MoneyManagementResource::make(dispatch_sync(new showJob($request->user()['uuid'], $uuid))));
        } catch (\Exception $exception) {
            return $this->respondWithError($exception);
        }
    }

    public function update(UpdateRequest $request, $uuid): JsonResponse
    {
        try {
            return $this->respond(MoneyManagementResource::make(dispatch_sync(new UpdateJob($request->user()['uuid'], $uuid, $request->validated()))));
        } catch (\Exception $exception) {
            return $this->respondWithError($exception);
        }
    }

    public function delete(Request $request, $uuid): JsonResponse
    {
        try {
            return $this->respondEntityRemoved(dispatch_sync(new DeleteJob($request->user()['uuid'], $uuid)));
        } catch (\Exception $exception) {
            return $this->respondWithError($exception);
        }
    }
}
