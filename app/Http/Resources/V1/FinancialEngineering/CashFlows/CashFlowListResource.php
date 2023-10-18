<?php

namespace App\Http\Resources\V1\FinancialEngineering\CashFlows;

use Illuminate\Http\Resources\Json\JsonResource;

class CashFlowListResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'uuid'   => $this->id,
            'title'  => $this->title,
            'public' => $this->public,
            'status' => $this->status,
        ];
    }
}
