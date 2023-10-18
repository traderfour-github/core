<?php
namespace App\Enums\V1\Market\Platform;

use App\Enums\V1\EnumTrait;

enum Type : string
{
    use EnumTrait;

    public const MT4       = 'MetaTrader 4';
    public const MT5       = 'MetaTrader 5';
}
