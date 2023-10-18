<?php

namespace App\Http\Controllers\V1\FinancialEngineering\ExitStrategy;

use App\Http\Controllers\V1\Controller;
use App\Http\Requests\V1\FinancialEngineering\ExitStrategy\CreateExitStrategyRequest;
use App\Http\Requests\V1\FinancialEngineering\ExitStrategy\UpdateExitStrategyRequest;
use App\Http\Resources\V1\FinancialEngineering\ExitStrategy\ExitStrategyListResource;
use App\Http\Resources\V1\FinancialEngineering\ExitStrategy\ExitStrategyResource;
use App\Jobs\V1\FinancialEngineering\ExitStrategy\DeleteJob;
use App\Jobs\V1\FinancialEngineering\ExitStrategy\IndexJob;
use App\Jobs\V1\FinancialEngineering\ExitStrategy\SingleJob;
use App\Jobs\V1\FinancialEngineering\ExitStrategy\StoreJob;
use App\Jobs\V1\FinancialEngineering\ExitStrategy\UpdateJob;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ExitStrategyController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        try {
            return $this->respond(ExitStrategyListResource::collection(dispatch_sync(new IndexJob($request->user()['uuid'], $request->only([])))));
        } catch (Exception $exception) {
            return $this->respondWithError($exception);
        }
    }

    public function show(Request $request, $id): JsonResponse
    {
        try {
            return $this->respond(ExitStrategyResource::make(dispatch_sync(new SingleJob($request->user()['uuid'], $id))));
        } catch (Exception $exception) {
            return $this->respondWithError($exception);
        }
    }

    public function store(CreateExitStrategyRequest $request): JsonResponse
    {
        try {
            return $this->respond(ExitStrategyResource::make(dispatch_sync(new StoreJob($request->user()['uuid'], $request->validated()))));
        } catch (Exception $exception) {
            return $this->respondWithError($exception);
        }
    }

    public function update(UpdateExitStrategyRequest $request, $id): JsonResponse
    {
        try {
            return $this->respond(ExitStrategyResource::make(dispatch_sync(new UpdateJob($request->user()['uuid'], $request->validated(), $id))));
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
