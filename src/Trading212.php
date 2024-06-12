<?php

namespace DanWithams\Trading212Api;

use DanWithams\Trading212Api\Requests\Equity\GetPies;

class Trading212
{
    protected Client $client;

    public function __construct(ClientConfig $config)
    {
        $this->client = new Client($config);
    }

    public function getPies(): array
    {
        return $this->client->sendRequest(new GetPies);
    }
}
