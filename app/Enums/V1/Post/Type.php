<?php

namespace App\Enums\V1\Post;

use App\Enums\V1\EnumTrait;

enum Type: int
{
    use EnumTrait;

    case BOT = 13000;
    case INDICATOR = 13001;
    case SYSTEM = 13002; // BOT + INDICATOR
    case SCRIPT = 13003; // RUN ONE TIME
    case TEMPLATE = 13004;
    case ALGORITHM = 13005; // SQX comes from AI
    case ARTIFICIAL_INTELLIGENCE = 13006; // LIVE AI from servers
    case PORTFOLIO = 13007;
    case AI_LIVE = 13008;
    case FUNDED_ACCOUNT = 13009;
    case TRADING_SIGNAL = 13010;
    case TRADING_STRATEGY = 13011;
    case COURSE = 13012;
    case VIDEO = 13013;
    case ARTICLE = 13014;
    case PODCAST = 13015;
    case SHORT_VIDEO = 13016;
    case DATA = 13017;
    case MODEL = 13018;
    case LIVE_STREAM = 13019;
    case OTHER = 13020;
}
