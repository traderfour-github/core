<?php
namespace App\Enums\V1\Post;

use App\Enums\V1\EnumTrait;

enum Status: int
{
    use EnumTrait;

    case Draft = 19100;
    case Pending = 19101;
    case Active = 19102;
    case Abandoned = 19103;
}
