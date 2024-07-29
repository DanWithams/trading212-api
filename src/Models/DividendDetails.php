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
        return new self(
            gained: $data['gained'],
            reinvested: $data['reinvested'],
            inCash: $data['inCash']
        );
    }
}
