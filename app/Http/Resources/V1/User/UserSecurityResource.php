<?php

namespace App\Http\Resources\V1\User;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Crypt;

class UserSecurityResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'anti_phishing'      => empty($this->anti_phishing) ? false : Crypt::decrypt($this->anti_phishing),
            'google2fa_secret'   => !is_null($this->google2fa_secret),
            'email_2step'        => $this->getEmail2Step(),
            'app_2step'          => $this->getApp2Step(),
            'mobile_2step'       => $this->getMobile2Step(),
            'same_wallet'        => $this->same_wallet,
            'fund_password'      => $this->fund_password,
            'registered_wallets' => $this->registered_wallets,
            'delay'              => $this->delay
        ];
    }

    private function getEmail2Step(): bool
    {
        $email2Step = $this->metas->where('key', 'email_2step')->first();

        return !empty(json_decode($email2Step?->value, true));
    }

    private function getApp2Step(): bool
    {
        $app2Step = $this->metas->where('key', 'app_2step')->first();

        return !empty(json_decode($app2Step?->value, true));
    }

    private function getMobile2Step(): bool
    {
        $mobile2Step = $this->metas->where('key', 'mobile_2step')->first();

        return !empty(json_decode($mobile2Step?->value, true));
    }
}
