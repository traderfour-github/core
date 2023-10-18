<?php

namespace App\Enums\V1\Market\Instrument;

use App\Enums\V1\EnumTrait;

abstract class InstrumentTradeMode
{
    use EnumTrait;

    const DISABLED = 12900;
    const LONG_ONLY = 12901;
    const SHORT_ONLY = 12902;
    const CLOSE_ONLY = 12903;
    const FULL = 12904;
}
