<?php

namespace DanWithams\Trading212Api\Models\Pies;

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
        $data = collect($data);

        return new self(
            investedValue: $data->get('investedValue'),
            result: $data->get('result'),
            resultCoefficient: $data->get('resultCoef'),
            value: $data->get('value')
        );
    }
}
