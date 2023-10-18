<?php

namespace App\Http\Middleware;

use App\Concerns\ApiResponse;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    use ApiResponse;

    protected function unauthenticated($request, array $guards)
    {
        abort($this->respondEntityNotFound(__('messages.respond.unauthenticated_message')));
    }
}
