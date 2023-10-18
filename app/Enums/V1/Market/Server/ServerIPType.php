<?php

namespace App\Enums\V1\Market\Server;

use App\Enums\V1\EnumTrait;

abstract class ServerIPType
{
    use EnumTrait;

    const IPV4 = 12970;
    const IPV6 = 12971;
}
