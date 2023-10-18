<?php

namespace App\Http\Controllers\V1\Market;

use App\Http\Controllers\V1\Controller;
use App\Http\Requests\V1\Market\Broker\GetBrokersListRequest;
use App\Http\Resources\V1\Market\Broker\BrokerListResource;
use App\Http\Resources\V1\Market\Broker\BrokerResource;
use App\Services\General\BrokerService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class BrokerController extends Controller
{
    public function __construct(
        private BrokerService $brokerService
    ) {
    }

    public function index(GetBrokersListRequest $request)
    {
        return $this->respond(BrokerListResource::collection($this->brokerService->list($request->validated())));
    }

    public function show(Request $request, $id)
    {
        try {
            $filters = $request->only(['market', 'platform', 'server', 'instrument']);
            return $this->respond(BrokerResource::make($this->brokerService->read($id, $filters)));
        } catch (ModelNotFoundException $exception) {
            return $this->respondEntityNotFound($exception);
        }
    }
}
