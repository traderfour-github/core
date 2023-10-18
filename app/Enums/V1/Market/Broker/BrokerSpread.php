<?php

namespace App\Enums\V1\Market\Broker;

use App\Enums\V1\EnumTrait;

abstract class BrokerSpread
{
    use EnumTrait;

    const WIDE = 11500;
    const FIXED = 11501;
    const HYBRID = 11502;
}
