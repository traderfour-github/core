<?php

namespace App\Http\Resources\V1\Werify;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'         => $this['id'],
            'name'       => $this['name'],
            'identifier' => $this['identifier'],
            'username'   => $this['username'],
            'profile'    => $this->when(!empty($this['profile']), fn() => UserProfileResource::make($this['profile'])),

            // todo: add resources
            // 'profile_badges' => $this->when(!empty($this['profile_badges']), fn() => UserProfileResource::make($this['profile_badges'])),
            // 'profile_numbers' => $this->when(!empty($this['profile_numbers']), fn() => UserProfileResource::make($this['profile_numbers'])),
            // 'profile_education' => $this->when(!empty($this['profile_education']), fn() => UserProfileResource::make($this['profile_education'])),
            // 'financial_information' => $this->when(!empty($this['financial_information']), fn() => UserProfileResource::make($this['financial_information'])),
            // 'profile_metas' => $this->when(!empty($this['profile_metas']), fn() => UserProfileResource::make($this['profile_metas'])),
        ];
    }
}
