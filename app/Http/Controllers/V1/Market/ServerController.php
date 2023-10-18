<?php

namespace App\Http\Controllers\V1\Market;

use App\Http\Controllers\V1\Controller;
use App\Http\Resources\V1\Market\Server\ServerListResource;
use App\Http\Resources\V1\Market\Server\ServerResource;
use App\Services\General\ServerService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Werify\Laravel\Jobs\Account\GetUserProfileJob;

class ServerController extends Controller
{
    public function __construct(
        private ServerService $serverService
    ) {
    }

    public function show(Request $request, $id)
    {
        try {
            $filters = $request->only(['market', 'broker', 'platform', 'instrument']);
            return $this->respond(ServerResource::make($this->serverService->read($id, $filters)));
        } catch (ModelNotFoundException $exception) {
            return $this->respondEntityNotFound($exception);
        }
    }

    public function brokerServers($broker_id, Request $request)
    {
        try {
            $platform_id = $request->input('platform_id');
            $user_id = null;

            if ($request->header('authorization') && $user = dispatch_sync(new GetUserProfileJob($request->header('authorization')))) {
                $user_id = $user['uuid'];
            }

            return $this->respond(ServerListResource::collection($this->serverService->brokerServers($broker_id, $platform_id, $user_id)));
        } catch (ModelNotFoundException $exception) {
            return $this->respondEntityNotFound($exception);
        }
    }
}
