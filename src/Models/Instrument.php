<?php

namespace DanWithams\Trading212Api\Models;

class Instrument
{
    public function __construct(
        public string $ticker,
        public array $result,
        public float $expectedShare,
        public float $currentShare,
        public float $ownedQuantity,
        public array $issues
    ) {

    }

    public static function hydrateFromApi(array $data): self
    {
        return new self(
            ticker: $data['ticker'],
            result: $data['result'],
            expectedShare: $data['expectedShare'],
            currentShare: $data['currentShare'],
            ownedQuantity: $data['ownedQuantity'],
            issues: $data['issues'],
        );
    }
}
