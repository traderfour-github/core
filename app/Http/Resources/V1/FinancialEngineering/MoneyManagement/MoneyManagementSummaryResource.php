<?php

namespace App\Http\Resources\V1\FinancialEngineering\MoneyManagement;

use Illuminate\Http\Resources\Json\JsonResource;

class MoneyManagementSummaryResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'uuid'  => $this->id,
            'title' => $this->title,
            'status' => $this->status,
        ];
    }
}
