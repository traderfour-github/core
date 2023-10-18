<?php

namespace App\Enums\V1\Post;

use App\Enums\V1\EnumTrait;

enum Comment: int
{
    use EnumTrait;

    case PUBLIC = 19000;
    case PRIVATE = 19001;
    case CLOSED = 19002;
    case SUBSCRIBERS = 19003;
}
