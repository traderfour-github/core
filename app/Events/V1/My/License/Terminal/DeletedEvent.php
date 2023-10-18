<?php

namespace App\Events\V1\My\License\Terminal;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class DeletedEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @param  string  $terminalId
     */
    public function __construct(
        public string $terminalId
    ) {
    }
}
