<?php

namespace App\Http\Controllers\V1\My\Market;

use App\Http\Controllers\V1\Controller;
use App\Http\Requests\V1\Market\Server\StoreServerRequest;
use App\Http\Resources\V1\Market\Server\ServerResource;
use App\Jobs\V1\Market\Server\StoreServerJob;

class ServerController extends Controller
{
    public function store(StoreServerRequest $request)
    {
        try {
            return $this->respond(ServerResource::make(dispatch_sync(new StoreServerJob($request->validated(), $request->user()['uuid']))));
        } catch (\Exception $exception) {
            return $this->exceptionHandler($exception);
        }
    }
}
