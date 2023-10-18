<?php

namespace App\Http\Controllers\V1\FinancialEngineering\RiskManagement;

use App\Http\Controllers\V1\Controller;
use App\Http\Requests\V1\FinancialEngineering\RiskManagement\CreateRiskManagementRequest;
use App\Http\Requests\V1\FinancialEngineering\RiskManagement\UpdateRiskManagementRequest;
use App\Http\Resources\V1\FinancialEngineering\RiskManagement\RiskManagementListResource;
use App\Http\Resources\V1\FinancialEngineering\RiskManagement\RiskManagementResource;
use App\Jobs\V1\FinancialEngineering\RiskManagement\DeleteJob;
use App\Jobs\V1\FinancialEngineering\RiskManagement\IndexJob;
use App\Jobs\V1\FinancialEngineering\RiskManagement\SingleJob;
use App\Jobs\V1\FinancialEngineering\RiskManagement\StoreJob;
use App\Jobs\V1\FinancialEngineering\RiskManagement\UpdateJob;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RiskManagementController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        try {
            return $this->respond(RiskManagementListResource::collection(dispatch_sync(new IndexJob($request->user()['uuid'], $request->only([])))));
        } catch (Exception $exception) {
            return $this->respondWithError($exception);
        }
    }

    public function show(Request $request, $id): JsonResponse
    {
        try {
            return $this->respond(RiskManagementResource::make(dispatch_sync(new SingleJob($request->user()['uuid'], $id))));
        } catch (Exception $exception) {
            return $this->respondWithError($exception);
        }
    }

    public function store(CreateRiskManagementRequest $request): JsonResponse
    {
        try {
            return $this->respond(RiskManagementResource::make(dispatch_sync(new StoreJob($request->user()['uuid'], $request->validated()))));
        } catch (Exception $exception) {
            return $this->respondWithError($exception);
        }
    }

    public function update(UpdateRiskManagementRequest $request, $id): JsonResponse
    {
        try {
            return $this->respond(RiskManagementResource::make(dispatch_sync(new UpdateJob($request->user()['uuid'], $request->validated(), $id))));
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
