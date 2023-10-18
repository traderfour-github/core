<?php

namespace App\Http\Resources\V1\FinancialEngineering\CashFlows\CashFlowItems;

use Illuminate\Http\Resources\Json\JsonResource;

class CashFlowItemListResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'uuid'      => $this->id,
            'title'     => $this->title,
            'is_public' => $this->is_public,
            'status'    => $this->status,
        ];
    }
}
