<?php

namespace App\Events\V1\RiskManagement;

use App\Models\Trader4\V1\FinancialEngineering\RiskManagement;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class RiskManagementCreatedEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(
        RiskManagement $riskManagement
    )
    {
    }

}
