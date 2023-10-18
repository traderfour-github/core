<?php

namespace App\Events\V1\My\License\License;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class DeletedEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @param  string  $licenseId
     */
    public function __construct(
        public string $licenseId
    ) {
    }
}
