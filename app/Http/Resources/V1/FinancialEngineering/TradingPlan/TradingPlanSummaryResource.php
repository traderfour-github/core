<?php

namespace App\Http\Resources\V1\FinancialEngineering\TradingPlan;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TradingPlanSummaryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     *
     * @return array
     */
    public function toArray($request)
    {
        return [
            'uuid' => $this->id,
            'public' => $this->public,
            'status' => $this->status,
        ];
    }
}
