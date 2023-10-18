<?php

namespace App\Enums\V1\Market\Instrument;

use App\Enums\V1\EnumTrait;

abstract class InstrumentExpirationMode
{
    use EnumTrait;

    const GTC = 12940;
    const DAY = 12941;
    const SPECIFIED = 12942;
    const SPECIFIED_DAY = 12943;
}
