<?php

namespace App\Enums\V1\Market\Server;

use App\Enums\V1\EnumTrait;

abstract class ServerProxyType
{
    use EnumTrait;

    const SOCKS4 = 12980;
    const SOCKS5 = 12981;
    const HTTP = 12982;
}
