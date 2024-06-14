<?php

namespace DanWithams\Trading212Api\Requests;

use DanWithams\Trading212Api\Enums\HttpVerb;

abstract class BaseRequest
{
    abstract public function getVerb(): HttpVerb;
    abstract public function getResourceUri(): string;
    abstract public function getParams(): array;
    abstract public function getData(): array;
    abstract public function getBody(): ?string;
    abstract public static function getResponseClass(): string;

    public function createResponseObject(array $data)
    {
        return new (static::getResponseClass())($data);
    }
}
