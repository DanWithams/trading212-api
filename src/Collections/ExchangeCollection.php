<?php

namespace DanWithams\Trading212Api\Collections;

use DanWithams\Trading212Api\Models\Instrument;
use DanWithams\Trading212Api\Models\InstrumentsMetaData\Exchange;
use Illuminate\Support\Collection;

class ExchangeCollection extends Collection
{
    public function __construct($array = [])
    {
        parent::__construct(
            array_map(fn ($item) => $item instanceof Exchange ? $item : Exchange::hydrateFromApi($item), $array)
        );
    }
}
