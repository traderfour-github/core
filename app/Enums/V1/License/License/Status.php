<?php
namespace App\Enums\V1\License\License;

use App\Enums\V1\EnumTrait;

enum Status: int
{
    use EnumTrait;

    case Active = 17000;

    case inActive = 17001;
}
