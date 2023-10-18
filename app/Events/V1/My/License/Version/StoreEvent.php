<?php

namespace App\Events\V1\My\License\Version;

use App\Models\Trader4\V1\License\Version;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class StoreEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(Version $version)
    {
        //
    }
}
