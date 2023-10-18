<?php

namespace App\Enums\V1\Market\Broker;

use App\Enums\V1\EnumTrait;

abstract class BrokerStatus
{
    use EnumTrait;

    const ACTIVE = 11400;
    const INACTIVE = 11401;
}
