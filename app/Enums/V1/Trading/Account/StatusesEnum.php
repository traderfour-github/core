<?php

namespace App\Enums\V1\Trading\Account;

use App\Enums\V1\EnumTrait;

enum StatusesEnum: int
{
    use EnumTrait;

    case Registered = 15001;
    case Pending = 15002;
    case Active = 15003;
    case Suspended = 15004;
    case Closed = 15005;
    case Canceled = 15006;
    case Deleted = 15007;
    case Rejected = 15008;
    case PendingDeletion = 15009;
    case PendingCancellation = 15010;
    case PendingSuspension = 15011;
    case PendingActivation = 15012;
}
