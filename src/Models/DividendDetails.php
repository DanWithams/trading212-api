<?php

namespace DanWithams\Trading212Api\Models;

readonly class DividendDetails
{
    public readonly float $gained;
    public readonly float $reinvested;
    public readonly float $inCash;

    public function __construct(array $data)
    {
        $this->gained = $data['gained'];
        $this->reinvested = $data['reinvested'];
        $this->inCash = $data['inCash'];
    }
}
