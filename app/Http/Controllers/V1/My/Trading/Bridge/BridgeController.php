<?php

namespace App\Http\Controllers\V1\My\Trading\Bridge;

use App\Http\Controllers\V1\Controller;
use App\Http\Requests\V1\Bridge\WebhookRequest;
use App\Http\Resources\V1\Bridge\BridgeWebhookSummaryResource;
use App\Jobs\V1\Bridge\BridgeWebhookJob;
use App\Models\Trader4\V1\Trading\Account;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

use const Widmogrod\Functional\identity;

class BridgeController extends Controller
{
    public function call(WebhookRequest $request) : JsonResponse{

        return $this->respond(
            BridgeWebhookSummaryResource::make(BridgeWebhookJob::dispatchSync($request->validated()))
        );
    }

    public function join(Request $r): \Illuminate\Auth\Access\Response|\Illuminate\Http\JsonResponse
    {
        try{
            $access = false;
            $identity = $r->input('identity');
            $user = $r->user();
            if (!$user) return $this->respond(['access' => false]);
            if (!$identity) return $this->respond(['access' => false]);
            $account = Account::where(['user_id' => $user['uuid'], 'identity' => $identity])->first();
            if($account) $access = true;
            $access = true;
            return $this->respond(['identity' => $identity, 'access' => $access]);
        }catch (\Exception $e){
            return $this->exceptionHandler($e);
        }
    }
}
