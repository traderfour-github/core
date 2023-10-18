<?php

namespace App\Http\Resources\V1\User;

use Illuminate\Http\Resources\Json\JsonResource;

class UserSettingResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'daily_report'  => $this->daily_report,
            'auto_renewal'  => $this->auto_renewal,
            'auto_withdraw' => $this->auto_withdraw
        ];
    }
}
