<?php

namespace DanWithams\Trading212Api\Models;

readonly class DividendDetails
{
    public function __construct(
        public float $gained,
        public float $reinvested,
        public float $inCash
    ) {

    }

    public static function hydrateFromApi(array $data): self
    {
        $data = collect($data)->filter(fn ($item) => ! is_null($item));

        return new self(
            gained: $data->get('gained'),
            reinvested: $data->get('reinvested'),
            inCash: $data->get('inCash')
        );
    }
}
