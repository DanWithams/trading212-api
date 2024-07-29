<?php

namespace DanWithams\Trading212Api\Models\Equity;

readonly class PieResult
{
    public function __construct(
        public float $investedValue,
        public float $result,
        public float $resultCoefficient,
        public float $value
    ) {

    }

    public static function hydrateFromApi(array $data): self
    {
        return new self(
            investedValue: $data['investedValue'],
            result: $data['result'],
            resultCoefficient: $data['resultCoef'],
            value: $data['value']
        );
    }
}
