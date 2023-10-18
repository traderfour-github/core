<?php

namespace App\Enums\V1\Market\Instrument;

use App\Enums\V1\EnumTrait;

abstract class InstrumentFillingMode
{
    use EnumTrait;

    const FOK = 12930;
    const IOC = 12931;
    const RETURN = 12932;
}
