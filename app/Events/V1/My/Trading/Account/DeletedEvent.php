<?php

namespace App\Events\V1\My\Trading\Account;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class DeletedEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @param  string  $tradingAccountId
     */
    public function __construct(
        public string $tradingAccountId
    ) {
    }
}
