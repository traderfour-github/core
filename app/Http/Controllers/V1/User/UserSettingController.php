<?php

namespace App\Http\Controllers\V1\User;

use App\Http\Controllers\V1\Controller;
use App\Http\Requests\V1\User\UserNotificationSettingRequest;
use App\Http\Requests\V1\User\UserSettingRequest;
use App\Http\Resources\V1\User\UserNotificationSettingResource;
use App\Http\Resources\V1\User\UserSettingResource;
use App\Jobs\V1\User\Setting\UserNotificationSettingUpdateJob;
use App\Jobs\V1\User\Setting\UserSettingUpdateJob;
use App\Repositories\UserNotificationSettingRepository;
use App\Repositories\UserSettingRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserSettingController extends Controller
{
    public function __construct(
        private UserSettingRepository $userSettingRepository,
        private UserNotificationSettingRepository $userNotificationSettingRepository,
    ) {
    }


    public function get(Request $request) : JsonResponse
    {
        try {
            $userSettings = $this->userSettingRepository->findOneBy(['user_id' => $request->user()['id']]);

            return $this->respond(UserSettingResource::make($userSettings));
        } catch (ModelNotFoundException $exception){

            return $this->respondWithError(__('messages.respond.not_found'));
        }

    }


    public function update(UserSettingRequest $request) : JsonResponse
    {
        $user = $this->dispatch(new UserSettingUpdateJob($request));

        return $this->setMessage(__('messages.respond.successful_update_message'))
            ->respond(UserSettingResource::make($user));
    }


    public function getNotificationSetting(Request $request) : JsonResponse
    {
        try {
            $userNotificationSettings = $this->userNotificationSettingRepository
                ->where('user_id', $request->user()['id'])->first();

            return $this->respond(UserNotificationSettingResource::make($userNotificationSettings));
        } catch (ModelNotFoundException $exception){
            return $this->respondWithError(__('messages.respond.not_found'));
        }
    }


    public function updateNotificationSetting(UserNotificationSettingRequest $request) : JsonResponse
    {
        $notification = $this->dispatch(new UserNotificationSettingUpdateJob($request));

        return $this->setMessage(__('messages.respond.successful_update_message'))
            ->respond(UserNotificationSettingResource::make($notification));
    }
}
