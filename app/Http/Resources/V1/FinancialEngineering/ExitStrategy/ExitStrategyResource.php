<?php

namespace App\Http\Resources\V1\FinancialEngineering\ExitStrategy;

use App\Http\Resources\V1\FinancialEngineering\TradingStrategy\TradingStrategySummaryResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ExitStrategyResource extends JsonResource
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
            'description' => $this->description,
            'order_type' => $this->order_type,
            'source' => $this->source,
            'source_type' => $this->source_type,
            'source_settings' => $this->source_settings,
            'comparison' => $this->comparison,
            'trigger' => $this->trigger,
            'is_required' => $this->is_required,
            'time_frame' => $this->time_frame,
            'data_feed' => $this->data_feed,
            'trading_strategy' => TradingStrategySummaryResource::make($this->tradingStrategy),
        ];
    }
}
