<?php

namespace App\Enums\V1\Market\Instrument;

use App\Enums\V1\EnumTrait;

abstract class InstrumentExecutionMode
{
    use EnumTrait;

    const REQUEST = 12910;
    const INSTANT = 12911;
    const MARKET = 12912;
    const EXCHANGE = 12913;
}
