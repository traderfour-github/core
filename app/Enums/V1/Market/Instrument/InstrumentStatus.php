<?php

namespace App\Enums\V1\Market\Instrument;

use App\Enums\V1\EnumTrait;

abstract class InstrumentStatus
{
    use EnumTrait;

    const ACTIVE = 12700;
    const INACTIVE = 12701;
}
