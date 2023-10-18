<?php

namespace App\Http\Controllers\V1\Market;

use App\Http\Controllers\V1\Controller;
use App\Http\Resources\V1\Market\Instrument\InstrumentListResource;
use App\Http\Resources\V1\Market\Instrument\InstrumentResource;
use App\Services\General\InstrumentService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class InstrumentController extends Controller
{
    public function __construct(
        private InstrumentService $instrumentService
    ) {
    }

    public function show(Request $request, $id)
    {
        try {
            $filters = $request->only(['market', 'broker', 'platform', 'server']);
            return $this->respond(InstrumentResource::make($this->instrumentService->read($id, $filters)));
        } catch (ModelNotFoundException $exception) {
            return $this->respondEntityNotFound($exception);
        }
    }

    public function serverInstruments($server_id)
    {
        try {
            return $this->respond(InstrumentListResource::collection($this->instrumentService->serverInstruments($server_id)));
        } catch (ModelNotFoundException $exception) {
            return $this->respondEntityNotFound($exception);
        }
    }
}
