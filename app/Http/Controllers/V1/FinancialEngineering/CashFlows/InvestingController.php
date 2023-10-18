<?php

namespace App\Http\Controllers\V1\FinancialEngineering\CashFlows;

use App\Http\Resources\V1\FinancialEngineering\CashFlows\CashFlowItems\CashFlowItemListResource;
use App\Http\Resources\V1\FinancialEngineering\CashFlows\CashFlowItems\CashFlowItemResource;
use App\Jobs\V1\FinancialEngineering\CashFlow\Investing\IndexJob;
use App\Jobs\V1\FinancialEngineering\CashFlow\Investing\ShowJob;
use App\Jobs\V1\FinancialEngineering\CashFlow\Investing\DeleteJob;
use App\Jobs\V1\FinancialEngineering\CashFlow\Investing\StoreJob;
use App\Jobs\V1\FinancialEngineering\CashFlow\Investing\UpdateJob;
use App\Http\Controllers\V1\Controller;
use App\Http\Requests\V1\FinancialEngineering\CashFlow\Investing\StoreRequest;
use App\Http\Requests\V1\FinancialEngineering\CashFlow\Investing\UpdateRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class InvestingController extends Controller
{
    public function index(Request $request, $cash_flow_id): JsonResponse
    {
        try {
            return $this->respond(CashFlowItemListResource::collection(dispatch_sync(new IndexJob($request->user()['uuid'], $cash_flow_id, $request->only([])))));
        } catch (\Exception $exception) {
            return $this->respondWithError($exception);
        }
    }

    public function store(StoreRequest $request): JsonResponse
    {
        try {
            return $this->respond(CashFlowItemResource::make(dispatch_sync(new StoreJob($request->validated()))));
        } catch (\Exception $exception) {
            return $this->respondWithError($exception);
        }
    }

    public function show(Request $request, $uuid): JsonResponse
    {
        try {
            return $this->respond(CashFlowItemResource::make(dispatch_sync(new ShowJob($request->user()['uuid'], $uuid))));
        } catch (\Exception $exception) {
            return $this->respondWithError($exception);
        }
    }

    public function update(UpdateRequest $request, $uuid): JsonResponse
    {
        try {
            return $this->respond(CashFlowItemResource::make(dispatch_sync(new UpdateJob($request->user()['uuid'], $request->validated(), $uuid))));
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
