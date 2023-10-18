<?php

namespace App\Enums\V1\Market\Instrument;

use App\Enums\V1\EnumTrait;

abstract class InstrumentSpread
{
    use EnumTrait;

    const WIDE = 12800;
    const FIXED = 12801;
    const HYBRID = 12802;
}
