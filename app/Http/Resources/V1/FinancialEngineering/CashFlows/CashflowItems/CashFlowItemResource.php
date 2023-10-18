<?php

namespace App\Http\Resources\V1\FinancialEngineering\CashFlows\CashFlowItems;

use App\Http\Resources\V1\FinancialEngineering\CashFlows\CashFlowSummaryResource;
use Illuminate\Http\Resources\Json\JsonResource;

class CashFlowItemResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'uuid'      => $this->id,
            'title'     => $this->title,
            'amount'    => $this->amount,
            'from'      => $this->from,
            'till'      => $this->till,
            'is_public' => $this->is_public,
            'status'    => $this->status,
            'cash_flow' => CashFlowSummaryResource::make($this->cashFlow),
            'parent'    => CashFlowItemSummaryResource::make($this->parent),
            'children'  => CashFlowItemSummaryResource::collection($this->children),
        ];
    }
}
