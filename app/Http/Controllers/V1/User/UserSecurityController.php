<?php

namespace App\Http\Controllers\V1\User;

use App\Http\Controllers\V1\Controller;
use App\Http\Requests\V1\User\UserSecurityRequest;
use App\Http\Resources\Google2FAResource;
use App\Http\Resources\V1\User\UserSecurityResource;
use App\Jobs\V1\User\Security\UserSecurityUpdateJob;
use App\Repositories\UserSecurityRepository;
use App\Services\User\UpdateUserSecuritiesService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Encryption\Encrypter;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserSecurityController extends Controller
{
    public function __construct(
        private UserSecurityRepository      $userSecurityRepository,
        private UpdateUserSecuritiesService $updateUserSecuritiesService,
        private Encrypter $encrypter
    ) {
    }


    public function get(Request $request) : JsonResponse
    {
        try {
            $userSecurities = $this->userSecurityRepository->where('user_id',$request->user()['id'])->first();

            if(!is_null($userSecurities)){
                return $this->respond(UserSecurityResource::make($userSecurities));
            }
            return $this->respondWithError(__('messages.respond.not_found'));
        } catch (ModelNotFoundException $exception) {

            return $this->respondWithError(__('messages.respond.not_found'));
        }
    }


    public function update(UserSecurityRequest $request) : JsonResponse
    {
        $user = $this->dispatch(new UserSecurityUpdateJob($request));

        return $this->setMessage(__('messages.respond.successful_update_message'))
            ->respond(UserSecurityResource::make($user));
    }


    public function google2faUpdate(Request $request)
    {
        if (is_null($request->user()['identifier'])){
            return $this->respondWithError(__('messages.respond.email_not_set'));
        }

        $google2fa = app('pragmarx.google2fa');
        $secret = $google2fa->generateSecretKey();
        $qrImage = $google2fa->getQRCodeInline(
            config('app.name'),
            $request->user()['identifier'],
            $secret
        );

        $encryptSecret = $this->encrypter->encrypt($secret);

        return $this->respond(Google2FAResource::make([
            'secret' => $encryptSecret,
            'qr' => base64_encode($qrImage)
        ]));
    }


    public function google2faVerify(Request $request)
    {
        $request->validate([
            'secret' => 'required|string',
            'code' => 'required|string',
        ]);

        if (is_null($request->user()['identifier'])){
            return $this->respondWithError(__('messages.respond.email_not_set'));
        }

        $google2fa = app('pragmarx.google2fa');
        $verify = $google2fa->verifyGoogle2FA(
            $this->encrypter->decrypt($request->secret),
            $request->code
        );

        if (!$verify){
            return $this->respondWithError(__('messages.respond.verify_failed'));
        }

        $this->updateUserSecuritiesService->perform($request->user()['id'], [
            'google2fa_secret' => $request->secret
        ]);

        return $this->setMessage(__('messages.respond.successful_update_message'))->respond();
    }
}
