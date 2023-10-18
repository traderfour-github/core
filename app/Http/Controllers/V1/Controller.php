<?php

namespace App\Http\Controllers\V1;

use App\Concerns\ApiExternal;
use App\Concerns\FileSystem;
use Briofy\RestLaravel\Http\Controllers\RestController;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;

use function Sentry\captureException;

class Controller extends RestController
{
    use AuthorizesRequests;
    use DispatchesJobs;
    use ValidatesRequests;
    use ApiExternal;
    use FileSystem;

    public function exceptionHandler(\Exception $exception): \Illuminate\Http\JsonResponse
    {
        captureException($exception);
        return $this->respond($exception->getMessage(), 500);
        return $this->respondWithError($exception);
    }

}
