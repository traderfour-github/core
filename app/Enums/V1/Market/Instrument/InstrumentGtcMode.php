<?php

namespace App\Enums\V1\Market\Instrument;

use App\Enums\V1\EnumTrait;

abstract class InstrumentGtcMode
{
    use EnumTrait;

    const GTC = 12920;
    const DAILY = 12921;
    const DAILY_EXCLUDING_STOPS = 12922;
}
