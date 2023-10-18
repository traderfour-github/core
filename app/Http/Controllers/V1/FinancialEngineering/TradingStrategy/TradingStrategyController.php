<?php

namespace App\Http\Controllers\V1\FinancialEngineering\TradingStrategy;

use App\Http\Controllers\V1\Controller;
use App\Http\Requests\V1\FinancialEngineering\TradingStrategy\CreateTradingStrategyRequest;
use App\Http\Requests\V1\FinancialEngineering\TradingStrategy\UpdateTradingStrategyRequest;
use App\Http\Resources\V1\FinancialEngineering\TradingStrategy\TradingStrategyListResource;
use App\Http\Resources\V1\FinancialEngineering\TradingStrategy\TradingStrategyResource;
use App\Jobs\V1\FinancialEngineering\TradingStrategy\DeleteJob;
use App\Jobs\V1\FinancialEngineering\TradingStrategy\IndexJob;
use App\Jobs\V1\FinancialEngineering\TradingStrategy\SingleJob;
use App\Jobs\V1\FinancialEngineering\TradingStrategy\StoreJob;
use App\Jobs\V1\FinancialEngineering\TradingStrategy\UpdateJob;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TradingStrategyController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        try {
            return $this->respond(TradingStrategyListResource::collection(dispatch_sync(new IndexJob($request->user()['uuid'], $request->only([])))));
        } catch (Exception $exception) {
            return $this->respondWithError($exception);
        }
    }

    public function show(Request $request, $id): JsonResponse
    {
        try {
            return $this->respond(TradingStrategyResource::make(dispatch_sync(new SingleJob($request->user()['uuid'], $id))));
        } catch (Exception $exception) {
            return $this->respondWithError($exception);
        }
    }

    public function store(CreateTradingStrategyRequest $request): JsonResponse
    {
        try {
            return $this->respond(TradingStrategyResource::make(dispatch_sync(new StoreJob($request->user()['uuid'], $request->validated()))));
        } catch (Exception $exception) {
            return $this->respondWithError($exception);
        }
    }

    public function update(UpdateTradingStrategyRequest $request, $id): JsonResponse
    {
        try {
            return $this->respond(TradingStrategyResource::make(dispatch_sync(new UpdateJob($request->user()['uuid'], $request->validated(), $id))));
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
