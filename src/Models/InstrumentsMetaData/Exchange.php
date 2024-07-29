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
        $data = collect($data)->filter(fn ($item) => ! is_null($item));

        return new self(
            id: $data->get('id'),
            name: $data->get('name'),
            workingSchedules: new WorkingScheduleCollection($data->get('workingSchedules')),
        );
    }
}
