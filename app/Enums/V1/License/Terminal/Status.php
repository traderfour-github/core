<?php
namespace App\Enums\V1\License\Terminal;

use App\Enums\V1\EnumTrait;

enum Status: int
{
    use EnumTrait;

    case Active = 17200;

    case inActive = 17201;
}
