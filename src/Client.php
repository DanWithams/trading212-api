<?php

namespace DanWithams\Trading212Api;

use DanWithams\Trading212Api\Requests\BaseRequest;
use DanWithams\Trading212Api\Responses\BaseResponse;
use DanWithams\Trading212Api\Responses\Contracts\ResponseContract;
use GuzzleHttp\Client as Guzzle;
use GuzzleHttp\HandlerStack;
use Psr\Http\Message\ResponseInterface;
use Throwable;

class Client
{
    public function __construct(public ClientConfig $config)
    {

    }

    protected function generateBaseUri(): string
    {
        return $this->config->getProtocol() . '://' . $this->config->getHostname(withPort: true) . '/api/v0/';
    }

    public function sendRequest(BaseRequest $request)
    {
        $httpClient = new Guzzle([
            'base_uri' => $this->generateBaseUri(),
            'headers' => [
                'Authorization' => $this->config->getSecret(),
                'Content-type' => 'application/json',
            ],
            ... $this->config->getMock() ? [ 'handler' => HandlerStack::create($this->config->getMock()) ] : [],
        ]);

        try {
            $response = $httpClient->request(
                $request->getVerb()->name,
                $request->getResourceUri(),
                [
                    'body' => $request->getBody(),
                ]
            );
        } catch (Throwable $throwable) {
            // TODO: Handle different exception types (4xx 5xx, other)
            if (method_exists($throwable, 'getResponse')) {
                var_dump((string) $throwable->getRequest()->getBody());
                var_dump((string) $throwable->getResponse()->getBody());
            }
            throw $throwable;
        }

        if (method_exists($response, 'getBody')) {
            var_dump((string) $response->getBody());
        }

        return $request->createResponse($response);
    }
}
