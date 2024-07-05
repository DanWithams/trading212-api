<?php

namespace DanWithams\Trading212Api\Collections;

use DanWithams\Trading212Api\Models\Equity\PieSummary;
use Illuminate\Support\Collection;

class PieCollection extends Collection
{
    public function __construct($array = [])
    {
        parent::__construct(
            array_map(fn ($data) => new PieSummary($data), $array)
        );
    }
}
