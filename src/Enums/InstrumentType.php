<?php

namespace DanWithams\Trading212Api\Enums;

enum InstrumentType: string
{
    case STOCK = 'STOCK';
    case ETF = 'ETF';
    case WARRANT = 'WARRANT';
}
