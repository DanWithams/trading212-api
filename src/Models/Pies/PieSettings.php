<?php

namespace DanWithams\Trading212Api\Models\Pies;

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
        $data = collect($data)->filter(fn ($item) => ! is_null($item));

        return new self(
            id: $data->get('id'),
            name: $data->get('name'),
            dividendCashAction: DividendCashAction::from($data->get('dividendCashAction')),
            goal: $data->get('goal'),
            initialInvestment: $data->get('initialInvestment'),
            instrumentShares: $data->get('instrumentShares'),
            icon: Icon::tryFrom($data->get('icon', '')),
            publicUrl: $data->get('publicUrl'),
            creationDate: Carbon::parse($data->get('creationDate')),
            endDate: Carbon::parse($data->get('endDate'))
        );
    }
}
