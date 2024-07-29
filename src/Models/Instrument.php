<?php

namespace DanWithams\Trading212Api\Models;

use DanWithams\Trading212Api\Enums\InstrumentType;

class Instrument
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
        return new self(
            ticker: $data['ticker'],
            type: InstrumentType::tryFrom($data['type'] ?? ''),
            workingScheduleId: $data['workingScheduleId'] ?? null,
            result: $data['result'] ?? null,
            expectedShare: $data['expectedShare'] ?? null,
            currentShare: $data['currentShare'] ?? null,
            ownedQuantity: $data['ownedQuantity'] ?? null,
            issues: $data['issues'] ?? null,
        );
    }
}
