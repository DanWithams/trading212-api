<?php

namespace DanWithams\Trading212Api\Models\InstrumentsMetaData;

use DanWithams\Trading212Api\Collections\WorkingScheduleCollection;

readonly class Exchange
{
    public function __construct(
        public int $id,
        public string $name,
        public ?WorkingScheduleCollection $workingSchedules = null
    ) {

    }

    public static function hydrateFromApi(array $data): self
    {
        return new self(
            id: $data['id'],
            name: $data['name'],
            workingSchedules: new WorkingScheduleCollection($data['workingSchedules']),
        );
    }
}
