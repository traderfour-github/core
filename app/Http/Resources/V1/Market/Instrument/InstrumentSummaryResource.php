<?php

namespace App\Http\Resources\V1\Market\Instrument;

use Illuminate\Http\Resources\Json\JsonResource;

class InstrumentSummaryResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'uuid'   => $this->id,
            'name'   => $this->name,
            'status' => $this->status,
        ];
    }
}
