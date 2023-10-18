<?php

namespace App\Http\Resources\V1\Market\Instrument;

use Illuminate\Http\Resources\Json\JsonResource;

class InstrumentListResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'uuid'     => $this->id,
            'name'     => $this->name,
            'slug'     => $this->slug,
            'logo'     => $this->logo,
            'sector'   => $this->sector,
            'industry' => $this->industry,
            'status'   => $this->status,
        ];
    }
}
