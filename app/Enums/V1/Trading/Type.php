<?php

namespace App\Enums\V1\Trading;

use App\Enums\V1\EnumTrait;

enum Type: int
{
    use EnumTrait;

    case Deposit_INIT = 17100;
    case Deposit      = 17101;
    case BUY          = 17102;
    case SELL         = 17103;
    case WITHDRAWAL   = 17104;
}
