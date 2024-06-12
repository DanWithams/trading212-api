<?php

namespace DanWithams\Trading212Api\Requests\Equity;

use DanWithams\Trading212Api\Enums\HttpVerb;
use DanWithams\Trading212Api\Requests\BaseRequest;

class GetPies extends BaseRequest
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

    public function getBody(): string
    {
        return '';
    }

}
