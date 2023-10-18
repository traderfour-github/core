<?php

namespace App\Enums\V1\Trading\Account;

use App\Enums\V1\EnumTrait;

enum MarginTypeEnum: int
{
    use EnumTrait;

    case RETAIL_NETTING = 15300;
    case EXCHANGE = 15301;
    case RETAIL_HEDGING = 15302;
}
