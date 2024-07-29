<?php

namespace DanWithams\Trading212Api\Models\Equity;

use DanWithams\Trading212Api\Contracts\HasId;
use DanWithams\Trading212Api\Models\DividendDetails;

readonly class PieSummary implements HasId
{
    public function __construct(
        public int $id,
        public float $cash,
        public DividendDetails $dividendDetails,
        public ?float $progress,
        public ?string $status,
        public PieResult $result
    ) {

    }

    public function getId(): int
    {
        return $this->id;
    }

    public static function hydrateFromApi(array $data): self
    {
        return new self(
            id: $data['id'],
            cash: $data['cash'],
            dividendDetails: DividendDetails::hydrateFromApi($data['dividendDetails']),
            progress: $data['progress'],
            status: $data['status'],
            result: PieResult::hydrateFromApi($data['result'])
        );
    }
}
