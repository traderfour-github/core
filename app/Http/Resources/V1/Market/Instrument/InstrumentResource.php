<?php

namespace App\Http\Resources\V1\Market\Instrument;

use App\Http\Resources\V1\Market\Market\MarketSummaryResource;
use App\Http\Resources\V1\Market\Platform\PlatformSummeryResource;
use App\Http\Resources\V1\Market\Server\ServerSummaryResource;
use Illuminate\Http\Resources\Json\JsonResource;

class InstrumentResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'uuid'         => $this->id,
            'name'                        => $this->name,
            'slug'                        => $this->slug,
            'logo'                        => $this->logo,
            'description'                 => $this->description,
            'sector'                      => $this->sector,
            'industry'                    => $this->industry,
            'digits'                      => $this->digits,
            'contract_size'               => $this->contract_size,
            'spread'                      => $this->spread,
            'stops_level'                 => $this->stops_level,
            'margin_currency'             => $this->margin_currency,
            'profit_currency'             => $this->profit_currency,
            'calculation_mode'            => $this->calculation_mode,
            'tick_size'                   => $this->tick_size,
            'tick_value'                  => $this->tick_value,
            'chart_mode'                  => $this->chart_mode,
            'margin_rate'                 => $this->margin_rate,
            'swap_rate'                   => $this->swap_rate,
            'sessions'                    => $this->sessions,
            'max_leverage'                => $this->max_leverage,
            'min_lot_size'                => $this->min_lot_size,
            'max_lot_size'                => $this->max_lot_size,
            'commission'                  => $this->commission,
            'commission_calculation_mode' => $this->commission_calculation_mode,
            'status'                      => $this->status,
            'server'         => ServerSummaryResource::make($this->server),
            'broker'         => MarketSummaryResource::make($this->broker),
            'platform'       => PlatformSummeryResource::make($this->platform),
        ];
    }
}
