<?php

namespace App\Enums\V1\Market\Instrument;

use App\Enums\V1\EnumTrait;

abstract class InstrumentSwapMode
{
    use EnumTrait;

    const DISABLED = 12960;
    const POINTS = 12961;
    const CURRENCY_SYMBOL = 12962;
    const CURRENCY_MARGIN = 12963;
    const CURRENCY_DEPOSIT = 12964;
    const INTEREST_CURRENT = 12965;
    const INTEREST_OPEN = 12966;
    const REOPEN_CURRENT = 12967;
    const REOPEN_BID = 12968;
}
