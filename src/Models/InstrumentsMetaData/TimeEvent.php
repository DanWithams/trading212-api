<?php

namespace DanWithams\Trading212Api\Models\InstrumentsMetaData;

use Carbon\Carbon;

readonly class TimeEvent
{
    public function __construct(
        public Carbon $date,
        public ?string $type = null
    ) {

    }

    public static function hydrateFromApi(array $data): self
    {
        return new self(
            date: Carbon::parse($data['date']),
            type: $data['type']
        );
    }
}
