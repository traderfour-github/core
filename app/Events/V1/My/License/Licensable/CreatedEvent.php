<?php

namespace App\Events\V1\My\License\Licensable;

use App\Models\Trader4\V1\License\Licensable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CreatedEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @param  Licensable  $licensable
     */
    public function __construct(
        public Licensable $licensable
    ) {
    }
}
