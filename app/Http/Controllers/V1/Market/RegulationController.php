<?php

namespace App\Http\Controllers\V1\Market;

use App\Enums\V1\Market\Regulations;
use App\Http\Controllers\V1\Controller;
use Illuminate\Http\JsonResponse;

class RegulationController extends Controller
{
    public function index(): JsonResponse
    {
        try{
            return $this->respond(Regulations::LIST);
        }catch (\Exception $exception){
            return $this->respondWithError($exception);
        }
    }
}
