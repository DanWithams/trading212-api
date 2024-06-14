<?php

namespace DanWithams\Trading212Api\Requests\Equity;

use DanWithams\Trading212Api\Enums\HttpVerb;
use DanWithams\Trading212Api\Requests\BaseRequest;
use DanWithams\Trading212Api\Responses\FetchPies as FetchPiesResponse;

class FetchPies extends BaseRequest
{
    public function getVerb(): HttpVerb
    {
        return HttpVerb::GET;
    }

    public function getResourceUri(): string
    {
        return 'equity/pies';
    }

    public function getParams(): array
    {
        return [];
    }

    public function getData(): array
    {
        return [];
    }

    public function getBody(): ?string
    {
        return '';
    }

    public static function getResponseClass(): string
    {
        return FetchPiesResponse::class;
    }
}
