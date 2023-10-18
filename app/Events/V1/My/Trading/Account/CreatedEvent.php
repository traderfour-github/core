<?php

namespace App\Events\V1\My\Trading\Account;

use App\Models\Trader4\V1\Trading\Account;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CreatedEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @param  Account  $tradingAccount
     */
    public function __construct(
        public Account $tradingAccount
    ) {
    }
}
