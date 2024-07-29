<?php

namespace DanWithams\Trading212Api\Models\Equity;

use Carbon\Carbon;
use DanWithams\Trading212Api\Enums\DividendCashAction;
use DanWithams\Trading212Api\Enums\Icon;

readonly class PieSettings
{
    public function __construct(
        public int $id,
        public string $name,
        public DividendCashAction $dividendCashAction,
        public ?float $goal,
        public ?float $initialInvestment,
        public ?array $instrumentShares,
        public ?Icon $icon,
        public ?string $publicUrl,
        public Carbon $creationDate,
        public Carbon $endDate,
    ) {

    }

    public static function hydrateFromApi(array $data): self
    {
        return new self(
            id: $data['id'],
            name: $data['name'],
            dividendCashAction: DividendCashAction::from($data['dividendCashAction']),
            goal: $data['goal'],
            initialInvestment: $data['initialInvestment'],
            instrumentShares: $data['instrumentShares'],
            icon: Icon::tryFrom($data['icon'] ?? ''),
            publicUrl: $data['publicUrl'],
            creationDate: Carbon::parse($data['creationDate']),
            endDate: Carbon::parse($data['endDate'])
        );
    }
}
