<?php

namespace DanWithams\Trading212Api;

use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Response;

class ClientConfig
{
    public function __construct(
        protected string $hostname,
        protected string $secret,
        protected ?string $port = null,
        protected bool $secure = true,
        protected ?MockHandler $mock = null
    ) {

    }

    public function isSecure(): bool
    {
        return $this->secure;
    }

    public function setSecure(bool $secure): ClientConfig
    {
        $this->secure = $secure;
        return $this;
    }

    public function getProtocol(): string
    {
        return $this->secure ? 'https' : 'http';
    }

    public function getHostname(bool $withPort = false): string
    {
        return $this->hostname . ($withPort ? ':' . $this->port : '');
    }

    public function setHostname(string $hostname): ClientConfig
    {
        $this->hostname = $hostname;
        return $this;
    }

    public function getPort(): string
    {
        return $this->port;
    }

    public function setPort(string $port): ClientConfig
    {
        $this->port = $port;
        return $this;
    }

    public function getSecret(): string
    {
        return $this->secret;
    }

    public function setSecret(string $secret): ClientConfig
    {
        $this->secret = $secret;
        return $this;
    }

    public function getMock(): ?MockHandler
    {
        return $this->mock;
    }

    public function setMock(MockHandler $mock): ClientConfig
    {
        $this->mock = $mock;
        return $this;
    }
}
