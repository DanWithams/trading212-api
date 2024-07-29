<?php

namespace DanWithams\Trading212Api\Requests\InstrumentsMetaData;

use DanWithams\Trading212Api\Collections\ExchangeCollection;
use DanWithams\Trading212Api\Enums\HttpVerb;
use DanWithams\Trading212Api\Requests\BaseRequest;
use Psr\Http\Message\ResponseInterface;

class FetchExchangeList extends BaseRequest
{
    public function getVerb(): HttpVerb
    {
        return HttpVerb::GET;
    }

    public function getResourceUri(): string
    {
        return 'equity/metadata/exchanges';
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

    public static function createResponse(ResponseInterface $response)
    {
        $data = self::parseResponse($response);

        return new ExchangeCollection($data);
    }
}
