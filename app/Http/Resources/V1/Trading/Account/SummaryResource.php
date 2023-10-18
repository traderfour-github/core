<?php

namespace App\Http\Resources\V1\Trading\Account;

use App\Models\Trader4\V1\Trading\Account;
use App\Services\Bridges\PlatformDetectionService;
use Illuminate\Http\Resources\Json\JsonResource;

class SummaryResource extends JsonResource
{
    public function toArray($request): array
    {
        $trading_account = Account::query()->find($request['trading_account'])?? abort(404 , __('messages.respond.not_exist'));

        return [
            'uuid'     => $trading_account->id ,
            'broker'   => $trading_account->broker,
            'identity' => $trading_account->identity,
            'platform' => (new PlatformDetectionService())->driver($request)
        ];
    }
}
