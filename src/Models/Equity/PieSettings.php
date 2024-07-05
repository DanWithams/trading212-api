<?php

namespace DanWithams\Trading212Api\Models\Equity;

use Carbon\Carbon;
use DanWithams\Trading212Api\Enums\DividendCashAction;
use DanWithams\Trading212Api\Enums\Icon;

readonly class PieSettings
{
    public int $id;
    public string $name;
    public DividendCashAction $dividendCashAction;
    public ?float $goal;
    public ?float $initialInvestment;
    public ?array $instrumentShares;
    public ?Icon $icon;
    public ?string $publicUrl;
    public Carbon $creationDate;
    public Carbon $endDate;

    public function __construct(array $data)
    {
        var_dump($data);

        $this->id = $data['id'];
        $this->name = $data['name'];
        $this->dividendCashAction = DividendCashAction::from($data['dividendCashAction']);
        $this->goal = $data['goal'];
        $this->initialInvestment = $data['initialInvestment'];
        $this->instrumentShares = $data['instrumentShares'];
        $this->icon = Icon::tryFrom($data['icon'] ?? '');
        $this->publicUrl = $data['publicUrl'];
        $this->creationDate = Carbon::parse($data['creationDate']);
        $this->endDate = Carbon::parse($data['endDate']);
    }
}
