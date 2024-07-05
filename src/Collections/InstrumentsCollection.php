<?php

namespace DanWithams\Trading212Api\Collections;

use DanWithams\Trading212Api\Models\Instrument;
use Illuminate\Support\Collection;

class InstrumentsCollection extends Collection
{
    public function __construct($array = [])
    {
        parent::__construct(
            array_map(fn ($data) => new Instrument($data), $array)
        );
    }
}
