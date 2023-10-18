<?php

namespace App\Http\Controllers\V1\Trading\Framework;

use App\Http\Resources\V1\Trading\Framework\SingleResource;
use App\Http\Resources\V1\Trading\Framework\IndexResource;
use App\Http\Controllers\V1\Controller;
use App\Jobs\V1\Trading\Framework\GetJob;
use App\Jobs\V1\Trading\Framework\ReadJob;
use App\Models\Trader4\V1\Trading\Framework;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FrameworkController extends Controller
{
    public function __construct(){}

    public function index(Request $request): JsonResponse
    {
        try{
            return $this->respond(
                IndexResource::collection(dispatch_sync(new GetJob($request->only(Framework::REQUEST_GET_HANDLER))))
            );
        }catch (\Exception $e){
            return $this->exceptionHandler($e);
        }
    }

    public function show($uuid): JsonResponse
    {
        try {
            return $this->respond(
                SingleResource::make(dispatch_sync(new ReadJob($uuid)))
            );
        }catch (\Exception $e) {
            return $this->respondWithError($e);
        }
    }
}
