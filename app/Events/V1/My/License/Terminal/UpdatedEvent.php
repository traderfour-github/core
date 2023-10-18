<?php

namespace App\Events\V1\My\License\Terminal;

use App\Models\Trader4\V1\License\Terminal;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UpdatedEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @param  Terminal  $terminal
     */
    public function __construct(
        public Terminal $terminal
    ) {
    }
}
