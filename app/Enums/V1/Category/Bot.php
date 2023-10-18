<?php
namespace App\Enums\V1\Category;

use App\Enums\V1\EnumTrait;

enum Bot: int
{
    use EnumTrait;

    case SCALPING = 13100;
    case DAY_TRADING =13101;
    case MOMENTUM = 13102;
    case TECHNICAL = 13103;
    case FUNDAMENTAL = 13104;
    case TECHNOMENTAL=13105;
    case MEAN_REVERSION=13106;
    case SWING = 13107;
    case POSITIONING = 13108;

}
