<?php

namespace App\Http\Resources\V1\Bridge;

use Illuminate\Http\Resources\Json\JsonResource;

class BridgeWebhookSummaryResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'app_key'          => $request->app_key,
            'order'            => $request->order,
            'instrument'       => $request->instrument,
            'stop_loss'        => $request->stop_loss,
            'target_price'     => $request->target_price,
            'risk'             => $request->risk,
            'risk_mode'        => $request->risk_mode,
            'trading_account'  => $request->trading_account
        ];
    }
}
