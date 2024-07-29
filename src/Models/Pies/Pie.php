<?php

namespace DanWithams\Trading212Api\Models\Pies;

use DanWithams\Trading212Api\Collections\InstrumentsCollection;
use DanWithams\Trading212Api\Contracts\HasId;

readonly class Pie implements HasId
{
    public function __construct(
        public InstrumentsCollection $instruments,
        public PieSettings $settings
    ) {

    }

    public function getId(): int
    {
        return $this->settings->id;
    }

    public static function hydrateFromApi(array $data): self
    {
        $data = collect($data);

        return new self(
            instruments: new InstrumentsCollection($data->get('instruments')),
            settings: PieSettings::hydrateFromApi($data->get('settings'))
        );
    }
}
