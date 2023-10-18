<?php

namespace App\Http\Resources\V1\User;

use Illuminate\Http\Resources\Json\JsonResource;

class UserNotificationSettingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'profit_email'      => $this->profit_email,
            'profit_push'       => $this->profit_push,
            'withdraw_email'    => $this->withdraw_email,
            'withdraw_push'     => $this->withdraw_push,
            'deposit_email'     => $this->deposit_email,
            'deposit_push'      => $this->deposit_push,
            'wallet_email'      => $this->wallet_email,
            'wallet_push'       => $this->wallet_push,
            'support_email'     => $this->support_email,
            'support_push'      => $this->support_push,
            'transaction_email' => $this->transaction_email,
            'transaction_push'  => $this->transaction_push,
            'marketing_email'   => $this->marketing_email,
            'marketing_push'    => $this->marketing_push
        ];
    }
}
