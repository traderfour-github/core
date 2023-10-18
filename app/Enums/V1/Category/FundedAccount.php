<?php
namespace App\Enums\V1\Category;

use App\Enums\V1\EnumTrait;

enum FundedAccount: int
{
    use EnumTrait;

    case REAL = 13200;
    case ONE_CHALLENGE =13201;
    case TWO_CHALLENGE = 13202;

}
