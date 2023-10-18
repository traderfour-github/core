<?php

namespace App\Enums\V1\Market\Instrument;

use App\Enums\V1\EnumTrait;

abstract class InstrumentSector
{
    use EnumTrait;

    const UNDEFINED = 12200;
    const BASIC_MATERIALS = 12201;
    const COMMUNICATION_SERVICES = 12202;
    const CONSUMER_CYCLICAL = 12203;
    const CONSUMER_DEFENSIVE = 12204;
    const CURRENCY = 12205;
    const CURRENCY_CRYPTO = 12206;
    const ENERGY = 12207;
    const FINANCIAL = 12208;
    const HEALTHCARE = 12209;
    const INDUSTRIALS = 12210;
    const REAL_ESTATE = 12211;
    const TECHNOLOGY = 12212;
    const UTILITIES = 12213;
}
