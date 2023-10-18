<?php

namespace App\Http\Controllers\V1\Market;

use App\Http\Controllers\V1\Controller;
use App\Http\Resources\V1\Market\Platform\PlatformListResource;
use App\Http\Resources\V1\Market\Platform\PlatformResource;
use App\Http\Resources\V1\Post\Platform\PlatformProductsResource;
use App\Services\General\PlatformService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PlatformController extends Controller
{
    public function __construct(
        private PlatformService $platformService
    ) {
    }

    public function index(Request $request)
    {
        $filters = $request->only(['title', 'status', 'sort', 'market', 'broker', 'server', 'instrument']);
        $items = $this->platformService->platformList($filters);

        return $this->respond(PlatformListResource::collection($items));
    }

    public function read(Request $request, $id)
    {
        try {
            $filters = $request->only(['market', 'broker', 'server', 'instrument']);
            return $this->respond(PlatformResource::make($this->platformService->read($id, $filters)));
        } catch (ModelNotFoundException $exception) {
            return $this->respondEntityNotFound($exception);
        }
    }

    public function marketPlatforms($id)
    {
        try {
            return $this->respond(PlatformListResource::collection($this->platformService->marketPlatforms($id)));
        } catch (ModelNotFoundException $exception) {
            return $this->respondEntityNotFound($exception);
        }
    }

    public function brokerPlatforms($id)
    {
        try {
            return $this->respond(PlatformListResource::collection($this->platformService->brokerPlatforms($id)));
        } catch (ModelNotFoundException $exception) {
            return $this->respondEntityNotFound($exception);
        }
    }

    public function products($uuid): JsonResponse
    {
        try{
            $items = $this->platformService->products($uuid);
            return $this->respond(PlatformProductsResource::collection($items));
        }catch (\Exception $exception){
            return $this->respondEntityNotFound($exception);
        }
    }
}
