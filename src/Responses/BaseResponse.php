<?php

namespace DanWithams\Trading212Api\Responses;

use ArrayAccess;
use Exception;
use JsonSerializable;

abstract class BaseResponse implements ArrayAccess, JsonSerializable
{
    public function __construct(protected array $data = [])
    {

    }

    public function offsetExists(mixed $offset): bool
    {
        return isset($this->data[$offset]);
    }

    public function offsetGet(mixed $offset): mixed
    {
        return $this->data[$offset];
    }

    /**
     * @throws Exception
     */
    public function offsetSet(mixed $offset, mixed $value): void
    {
        throw new Exception('Instances of "' . __CLASS__ . '" are immutable.');
    }

    /**
     * @throws Exception
     */
    public function offsetUnset(mixed $offset): void
    {
        throw new Exception('Instances of "' . __CLASS__ . '" are immutable.');
    }

    public function jsonSerialize(): array
    {
        return $this->data;
    }
}
