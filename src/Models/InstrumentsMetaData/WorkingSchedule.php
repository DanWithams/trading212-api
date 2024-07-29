<?php

namespace DanWithams\Trading212Api\Models\InstrumentsMetaData;

use DanWithams\Trading212Api\Collections\TimeEventCollection;

readonly class WorkingSchedule
{
    public function __construct(
        public int $id,
        public ?TimeEventCollection $timeEvents = null
    ) {

    }

    public static function hydrateFromApi(array $data): self
    {
        return new self(
            id: $data['id'],
            timeEvents: new TimeEventCollection($data['timeEvents'])
        );
    }
}
