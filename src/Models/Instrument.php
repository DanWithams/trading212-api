<?php

namespace DanWithams\Trading212Api\Models;

use DanWithams\Trading212Api\Enums\InstrumentType;

readonly class Instrument
{
    public function __construct(
        public string $ticker,
        public ?InstrumentType $type,
        public ?int $workingScheduleId,
        public ?array $result,
        public ?float $expectedShare,
        public ?float $currentShare,
        public ?float $ownedQuantity,
        public ?array $issues
    ) {

    }

    public static function hydrateFromApi(array $data): self
    {
        $data = collect($data)->filter(fn ($item) => ! is_null($item));

        return new self(
            ticker: $data->get('ticker'),
            type: InstrumentType::tryFrom($data->get('type', '')),
            workingScheduleId: $data->get('workingScheduleId'),
            result: $data->get('result'),
            expectedShare: $data->get('expectedShare'),
            currentShare: $data->get('currentShare'),
            ownedQuantity: $data->get('ownedQuantity'),
            issues: $data->get('issues')
        );
    }
}
