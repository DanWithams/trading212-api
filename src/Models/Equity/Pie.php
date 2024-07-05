<?php

namespace DanWithams\Trading212Api\Models\Equity;

use DanWithams\Trading212Api\Collections\InstrumentsCollection;
use DanWithams\Trading212Api\Contracts\HasId;

readonly class Pie implements HasId
{
    public InstrumentsCollection $instruments;
    public PieSettings $settings;

    public function __construct(array $data)
    {
        $this->instruments = new InstrumentsCollection($data['instruments']);
        $this->settings = new PieSettings($data['settings']);
    }

    public function getId(): int
    {
        return $this->settings->id;
    }
}
