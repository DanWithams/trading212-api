<?php

namespace DanWithams\Trading212Api\Models\AccountData;

use DanWithams\Trading212Api\Enums\Currency;

readonly class AccountMetadata
{
    public function __construct(
        public int $id,
        public Currency $currencyCode
    ) {

    }

    public static function hydrateFromApi(array $data): self
    {
        $data = collect($data)->filter(fn ($item) => ! is_null($item));

        return new self(
            id: $data->get('id'),
            currencyCode: Currency::from($data->get('currencyCode'))
        );
    }
}
