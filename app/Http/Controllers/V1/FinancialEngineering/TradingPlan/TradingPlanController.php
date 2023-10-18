<?php

namespace App\Http\Controllers\V1\FinancialEngineering\TradingPlan;

use App\Http\Controllers\V1\Controller;
use App\Http\Requests\V1\FinancialEngineering\TradingPlan\CreateTradingPlanRequest;
use App\Http\Requests\V1\FinancialEngineering\TradingPlan\UpdateTradingPlanRequest;
use App\Http\Resources\V1\FinancialEngineering\TradingPlan\TradingPlanListResource;
use App\Http\Resources\V1\FinancialEngineering\TradingPlan\TradingPlanResource;
use App\Jobs\V1\FinancialEngineering\TradingPlan\DeleteJob;
use App\Jobs\V1\FinancialEngineering\TradingPlan\IndexJob;
use App\Jobs\V1\FinancialEngineering\TradingPlan\SingleJob;
use App\Jobs\V1\FinancialEngineering\TradingPlan\StoreJob;
use App\Jobs\V1\FinancialEngineering\TradingPlan\UpdateJob;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TradingPlanController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        try {
            return $this->respond(TradingPlanListResource::collection(dispatch_sync(new IndexJob($request->user()['uuid'], $request->only([])))));
        } catch (Exception $exception) {
            return $this->respondWithError($exception);
        }
    }

    public function show(Request $request, $id): JsonResponse
    {
        try {
            return $this->respond(TradingPlanResource::make(dispatch_sync(new SingleJob($request->user()['uuid'], $id))));
        } catch (Exception $exception) {
            return $this->respondWithError($exception);
        }
    }

    public function store(CreateTradingPlanRequest $request): JsonResponse
    {
        try {
            return $this->respond(TradingPlanResource::make(dispatch_sync(new StoreJob($request->user()['uuid'], $request->validated()))));
        } catch (Exception $exception) {
            return $this->respondWithError($exception);
        }
    }

    public function update(UpdateTradingPlanRequest $request, $id): JsonResponse
    {
        try {
            return $this->respond(TradingPlanResource::make(dispatch_sync(new UpdateJob($request->user()['uuid'], $request->validated(), $id))));
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
