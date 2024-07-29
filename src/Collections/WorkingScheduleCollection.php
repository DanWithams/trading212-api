<?php

namespace DanWithams\Trading212Api\Collections;

use DanWithams\Trading212Api\Models\InstrumentsMetaData\TimeEvent;
use DanWithams\Trading212Api\Models\InstrumentsMetaData\WorkingSchedule;
use Illuminate\Support\Collection;

class WorkingScheduleCollection extends Collection
{
    public function __construct($array = [])
    {
        parent::__construct(
            array_map(fn ($item) => $item instanceof WorkingSchedule ? $item : WorkingSchedule::hydrateFromApi($item), $array)
        );
    }
}
