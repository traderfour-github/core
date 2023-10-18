<?php

namespace App\Http\Resources\V1\FinancialEngineering\MoneyManagement;

use App\Http\Resources\V1\Market\Instrument\InstrumentSummaryResource;
use App\Http\Resources\V1\Trading\Account\AccountSummaryResource;
use Illuminate\Http\Resources\Json\JsonResource;

class MoneyManagementResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'uuid'                      => $this->id,
            'title'                     => $this->title,
            'position_size'             => $this->position_size,
            'position_size_mode'        => $this->position_size_mode,
            'position_size_calculation' => $this->position_size_calculation,
            'maximum_size'              => $this->maximum_size,
            'minimum_size'              => $this->minimum_size,
            'status'                    => $this->status,
            'trading_account'           => AccountSummaryResource::make($this->tradingAccount),
            'instrument'                => InstrumentSummaryResource::make($this->instrument),
        ];
    }
}
