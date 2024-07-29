<?php

namespace DanWithams\Trading212Api\Models\Pies;

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
        $data = collect($data)->filter(fn ($item) => ! is_null($item));

        return new self(
            id: $data->get('id'),
            cash: $data->get('cash'),
            dividendDetails: DividendDetails::hydrateFromApi($data->get('dividendDetails')),
            progress: $data->get('progress'),
            status: $data->get('status'),
            result: PieResult::hydrateFromApi($data->get('result'))
        );
    }
}
