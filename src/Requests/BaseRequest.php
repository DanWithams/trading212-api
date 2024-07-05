<?php

namespace DanWithams\Trading212Api\Requests;

use DanWithams\Trading212Api\Enums\HttpVerb;
use Psr\Http\Message\ResponseInterface;

abstract class BaseRequest
{
    abstract public function getVerb(): HttpVerb;
    abstract public function getResourceUri(): string;
    abstract public function getParams(): array;
    abstract public function getData(): array;
    abstract public function getBody(): ?string;
    abstract public static function createResponse(ResponseInterface $response);

    public static function parseResponse(ResponseInterface $response): array
    {
        return json_decode((string) $response->getBody(), true);
    }
}
