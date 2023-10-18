<?php

namespace App\Enums\V1\Market\Instrument;

use App\Enums\V1\EnumTrait;

abstract class InstrumentOrderMode
{
    use EnumTrait;

    const MARKET = 12950;
    const LIMIT = 12951;
    const STOP = 12953;
    const STOP_LIMIT = 12953;
    const SL = 12954;
    const TP = 12955;
    const CLOSE_BY = 12956;
}
