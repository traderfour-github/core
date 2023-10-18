<?php

namespace App\Enums\V1\Trading\Account;

use App\Enums\V1\EnumTrait;

enum TradeModeEnum: int
{
    use EnumTrait;

    case DEMO = 15200;
    case CONTEST = 15201;
    case REAL = 15202;
}
