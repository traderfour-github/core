<?php

namespace App\Enums\V1\Market\Platform;

use App\Enums\V1\EnumTrait;

abstract class Status
{
    use EnumTrait;

    const ACTIVE = 11600;
    const INACTIVE = 11601;
}
