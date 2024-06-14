<?php

namespace DanWithams\Trading212Api\Requests\Equity;

use DanWithams\Trading212Api\Enums\HttpVerb;
use DanWithams\Trading212Api\Requests\BaseRequest;
use DanWithams\Trading212Api\Responses\FetchPie as FetchPieResponse;

class FetchPie extends BaseRequest
{
    public function __construct(protected int $id)
    {

    }

    public function getVerb(): HttpVerb
    {
        return HttpVerb::GET;
    }

    public function getResourceUri(): string
    {
        return 'equity/pies/' . $this->id;
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
        return null;
    }

    public static function getResponseClass(): string
    {
        return FetchPieResponse::class;
    }
}
