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
        return new self(
            free: $data['free'],
            invested: $data['invested'],
            pieCash: $data['pieCash'],
            ppl: $data['ppl'],
            result: $data['result'],
            total: $data['total'],
            blocked: $data['blocked']
        );
    }
}
