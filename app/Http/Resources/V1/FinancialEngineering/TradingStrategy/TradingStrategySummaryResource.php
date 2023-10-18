<?php

namespace App\Http\Resources\V1\FinancialEngineering\TradingStrategy;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TradingStrategySummaryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     *
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'public' => $this->public,
            'status' => $this->status,
        ];
    }
}
