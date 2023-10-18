<?php

namespace App\Events\V1\My\License\License;

use App\Models\Trader4\V1\License\License;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UpdatedEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @param  License  $license
     */
    public function __construct(
        public License $license
    ) {
    }
}
