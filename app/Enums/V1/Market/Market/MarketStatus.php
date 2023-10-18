<?php

namespace App\Enums\V1\Market\Market;

use App\Enums\V1\EnumTrait;

abstract class MarketStatus
{
    use EnumTrait;

    const ACTIVE = 11300;
    const INACTIVE = 11301;
}
