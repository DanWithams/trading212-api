<?php

namespace DanWithams\Trading212Api\Enums;

enum TimeEventType: string
{
    case OPEN = 'OPEN';
    case CLOSE = 'CLOSE';
    case PRE_MARKET_OPEN = 'PRE_MARKET_OPEN';
    case AFTER_HOURS_OPEN = 'AFTER_HOURS_OPEN';
    case AFTER_HOURS_CLOSE = 'AFTER_HOURS_CLOSE';
}
