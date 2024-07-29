<?php

namespace DanWithams\Trading212Api\Models\AccountData;

readonly class AccountCash
{
    public function __construct(
        public float $free,
        public float $invested,
        public float $pieCash,
        public float $ppl,
        public float $result,
        public float $total,
        public ?float $blocked = null
    ) {

    }

    public static function hydrateFromApi(array $data): self
    {
        $data = collect($data)->filter(fn ($item) => ! is_null($item));

        return new self(
            free: $data->get('free'),
            invested: $data->get('invested'),
            pieCash: $data->get('pieCash'),
            ppl: $data->get('ppl'),
            result: $data->get('result'),
            total: $data->get('total'),
            blocked: $data->get('blocked')
        );
    }
}
