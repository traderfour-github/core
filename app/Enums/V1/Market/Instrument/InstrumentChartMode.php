<?php

namespace App\Enums\V1\Market\Instrument;

use App\Enums\V1\EnumTrait;

abstract class InstrumentChartMode
{
    use EnumTrait;

    const BID_PRICE = 12600;
    const LAST_PRICE = 12601;
}
