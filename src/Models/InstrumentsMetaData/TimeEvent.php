<?php

namespace DanWithams\Trading212Api\Models\InstrumentsMetaData;

use Carbon\Carbon;
use DanWithams\Trading212Api\Enums\TimeEventType;

readonly class TimeEvent
{
    public function __construct(
        public Carbon $date,
        public TimeEventType $type
    ) {

    }

    public static function hydrateFromApi(array $data): self
    {
        $data = collect($data)->filter(fn ($item) => ! is_null($item));

        return new self(
            date: Carbon::parse($data->get('date')),
            type: TimeEventType::from($data->get('type'))
        );
    }
}
