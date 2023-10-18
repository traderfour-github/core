<?php

namespace App\Http\Controllers\V1\Market;

use App\Http\Controllers\V1\Controller;
use App\Http\Resources\V1\Market\Market\MarketListResource;
use App\Http\Resources\V1\Market\Market\MarketResource;
use App\Services\General\MarketService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class MarketController extends Controller
{
    public function __construct(
        private MarketService $marketService
    ) {
    }

    public function index(Request $request)
    {
        try{
            $filters = $request->only(['name', 'parent_id', 'status', 'sort', 'broker', 'platform', 'server', 'instrument']);
            $items = $this->marketService->list($filters);
            return $this->respond(MarketListResource::collection($items));
        }catch (\Exception $exception){
            return $this->respondEntityNotFound($exception);
        }
    }

    public function show(Request $request, $id)
    {
        try {
            $filters = $request->only(['status', 'sort', 'broker', 'platform', 'server', 'instrument']);
            return $this->respond(MarketResource::make($this->marketService->read($id, $filters)));
        } catch (ModelNotFoundException $exception) {
            return $this->respondEntityNotFound($exception);
        }
    }
}
