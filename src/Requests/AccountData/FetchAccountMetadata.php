<?php

namespace DanWithams\Trading212Api\Requests\AccountData;


use DanWithams\Trading212Api\Enums\HttpVerb;
use DanWithams\Trading212Api\Models\AccountData\AccountCash;
use DanWithams\Trading212Api\Models\AccountData\AccountMetadata;
use DanWithams\Trading212Api\Requests\BaseRequest;
use Psr\Http\Message\ResponseInterface;

class FetchAccountMetadata extends BaseRequest
{
    public function __construct()
    {

    }

    public function getVerb(): HttpVerb
    {
        return HttpVerb::GET;
    }

    public function getResourceUri(): string
    {
        return 'equity/account/info';
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

    public static function createResponse(ResponseInterface $response)
    {
        $data = self::parseResponse($response);

        return AccountMetadata::hydrateFromApi($data);
    }
}
