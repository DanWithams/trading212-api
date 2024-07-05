<?php

namespace DanWithams\Trading212Api\Models\Equity;

use DanWithams\Trading212Api\Contracts\HasId;
use DanWithams\Trading212Api\Models\DividendDetails;

readonly class PieSummary implements HasId
{
    public int $id;
    public float $cash;
    public DividendDetails $dividendDetails;
    public ?float $progress;
    public ?string $status;
    public PieResult $result;

    public function __construct(array $data)
    {
        $this->id = $data['id'];
        $this->cash = $data['cash'];
        $this->dividendDetails = new DividendDetails($data['dividendDetails']);
        $this->progress = $data['progress'];
        $this->status = $data['status'];
        $this->result = new PieResult($data['result']);
    }

    public function getId(): int
    {
        return $this->id;
    }
}
