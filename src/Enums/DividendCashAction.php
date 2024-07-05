<?php

namespace DanWithams\Trading212Api\Enums;

enum DividendCashAction: string
{
    case REINVEST = 'REINVEST';
    case TO_ACCOUNT_CASH = 'TO_ACCOUNT_CASH';
}
