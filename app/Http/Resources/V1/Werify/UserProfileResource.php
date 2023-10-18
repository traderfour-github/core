<?php

namespace App\Http\Resources\V1\Werify;

use Illuminate\Http\Resources\Json\JsonResource;

class UserProfileResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'first_name'    => $this['first_name'],
            'middle_name'   => $this['middle_name'],
            'last_name'     => $this['last_name'],
            'mobile_number' => $this['mobile_number'],
            'avatar'        => $this['avatar'],
            'cover'         => $this['cover'],
            'language'      => $this['language'],
            'timezone'      => $this['timezone'],
            'currency'      => $this['currency'],
            'is_private'    => $this['is_private'],
            'calendar'      => $this['calendar'],
            'shortcuts'     => $this['shortcuts'],
            'layout'        => $this['layout'],
            'latitude'      => $this['latitude'],
            'longitude'     => $this['longitude'],
            'last_online'   => $this['last_online'],
            'updated_at'    => $this['updated_at'],
        ];
    }
}
