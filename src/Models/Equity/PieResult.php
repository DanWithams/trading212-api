<?php

namespace DanWithams\Trading212Api\Models\Equity;

readonly class PieResult
{
    public function __construct(
        protected float $investedValue,
        protected float $result,
        protected float $resultCoefficient,
        protected float $value
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
