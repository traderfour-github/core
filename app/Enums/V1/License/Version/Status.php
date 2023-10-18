<?php
namespace App\Enums\V1\License\Version;

use App\Enums\V1\EnumTrait;

enum Status: int
{
    use EnumTrait;

    case Active = 17100;

    case inActive = 17101;
}
