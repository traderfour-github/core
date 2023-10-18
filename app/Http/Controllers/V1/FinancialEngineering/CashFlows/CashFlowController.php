<?php

namespace App\Http\Controllers\V1\FinancialEngineering\CashFlows;

use App\Http\Controllers\V1\Controller;
use App\Http\Requests\V1\FinancialEngineering\CashFlow\StoreRequest;
use App\Http\Requests\V1\FinancialEngineering\CashFlow\UpdateRequest;
use App\Http\Resources\V1\FinancialEngineering\CashFlows\CashFlowListResource;
use App\Http\Resources\V1\FinancialEngineering\CashFlows\CashFlowResource;
use App\Jobs\V1\FinancialEngineering\CashFlow\DeleteJob;
use App\Jobs\V1\FinancialEngineering\CashFlow\IndexJob;
use App\Jobs\V1\FinancialEngineering\CashFlow\ShowJob;
use App\Jobs\V1\FinancialEngineering\CashFlow\StoreJob;
use App\Jobs\V1\FinancialEngineering\CashFlow\UpdateJob;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CashFlowController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        try {
            return $this->respond(CashFlowListResource::collection(dispatch_sync(new IndexJob($request->user()['uuid'], $request->only([])))));
        } catch (\Exception $exception) {
            return $this->respondWithError($exception);
        }
    }

    public function store(StoreRequest $request): JsonResponse
    {
        try {
            return $this->respond(CashFlowResource::make(dispatch_sync(new StoreJob($request->user()['uuid'], $request->validated()))));
        } catch (\Exception $exception) {
            return $this->respondWithError($exception);
        }
    }

    public function show(Request $request, $uuid): JsonResponse
    {
        try {
            return $this->respond(CashFlowResource::make(dispatch_sync(new ShowJob($request->user()['uuid'], $uuid))));
        } catch (\Exception $exception) {
            return $this->respondWithError($exception);
        }
    }

    public function update(UpdateRequest $request, $uuid): JsonResponse
    {
        try {
            return $this->respond(CashFlowResource::make(dispatch_sync(new UpdateJob($request->user()['uuid'], $request->validated(), $uuid))));
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
