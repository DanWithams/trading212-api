<?php

namespace DanWithams\Trading212Api\Models\Equity;

readonly class PieResult
{
    protected readonly float $investedValue;
    protected readonly float $result;
    protected readonly float $resultCoefficient;
    protected readonly float $value;

    public function __construct(array $data)
    {
        $this->investedValue = $data['investedValue'];
        $this->result = $data['result'];
        $this->resultCoefficient = $data['resultCoef'];
        $this->value = $data['value'];
    }
}
