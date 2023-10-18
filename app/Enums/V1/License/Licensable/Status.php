<?php
namespace App\Enums\V1\License\Licensable;

use App\Enums\V1\EnumTrait;

enum Status: int
{
    use EnumTrait;

    case Active = 17400;

    case inActive = 17401;
}
