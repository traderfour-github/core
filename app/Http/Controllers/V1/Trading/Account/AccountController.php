<?php

namespace App\Http\Controllers\V1\Trading\Account;

use App\Http\Resources\V1\Trading\Account\IndexResource;
use App\Http\Resources\V1\Trading\Account\SingleResource;
use App\Models\Trader4\V1\Trading\Account;
use App\Http\Controllers\V1\Controller;
use App\Jobs\V1\Trading\Account\GetJob;
use App\Jobs\V1\Trading\Account\ReadJob;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function __construct() {}

    public function index(Request $request) : JsonResponse
    {
        try{
            return $this->respond(
                IndexResource::collection(dispatch_sync(new GetJob($request->only(Account::REQUEST_GET_HANDLER))))
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
