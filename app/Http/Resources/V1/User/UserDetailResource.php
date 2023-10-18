<?php

namespace App\Http\Resources\V1\User;

use Illuminate\Http\Resources\Json\JsonResource;

class UserDetailResource extends JsonResource
{
    private array $extra = [];

    public function toArray($request): array
    {
        return [
                'first_name'       => $this->first_name,
                'middle_name'     => $this->middle_name,
                'last_name'       => $this->last_name,
                'email'           => $this->email,
                'mobile'          => $this->mobile,
                'phone_number'    => $this->phone_number,
                'country'         => $this->country,
                'language'        => $this->language,
                'timezone'        => $this->timezone,
                'currency'        => $this->currency,
                'last_connection' => $this->last_connection,
                'private'         => $this->private,
                'avatar'          => $this->avatar,
            ] + $this->extra;
    }

    public function setExtra(array $attributes)
    {
        $this->extra = $attributes;

        return $this;
    }
}
