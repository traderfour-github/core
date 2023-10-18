<?php

namespace App\Http\Controllers\V1\User;

use App\Http\Controllers\V1\Controller;
use App\Http\Requests\V1\User\UserUpdateRequest;
use App\Http\Resources\V1\Post\PostResource;
use App\Http\Resources\V1\User\UserDetailResource;
use App\Http\Resources\V1\Werify\UserResource;
use App\Jobs\V1\User\UserUpdateInformationJob;
use App\Jobs\V1\User\UserUpdateJob;
use App\Services\User\UserProductService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Werify\IdLaravel\Jobs\GetUserProfileJob;

class UserController extends Controller
{
    public function __construct(
        private UserProductService $userProductService
    ) {
    }

    public function get(Request $request): JsonResponse
    {
        return $this->respond(UserResource::make($this->dispatch(new GetUserProfileJob($request->header('authorization')))));
    }

    public function update(UserUpdateRequest $request) : JsonResponse
    {
        $user = $this->dispatch(new UserUpdateJob($request));

        return $this->setUpdatedMessage()->respond(UserDetailResource::make($user));
    }

    public function updateInformation(Request $request) : JsonResponse
    {
        $this->dispatch(new UserUpdateInformationJob($request));

        return $this->respond();
    }

    public function products(Request $request)
    {
        $products = $this->userProductService->products($request->user()['id']);

        return $this->respond(PostResource::collection($products));
    }
}
