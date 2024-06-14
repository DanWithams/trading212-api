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

    public function sendRequest(BaseRequest $request): BaseResponse
    {
        $httpClient = new Guzzle([
            'base_uri' => $this->generateBaseUri(),
            'headers' => [
                'Authorization' => $this->config->getSecret(),
            ],
            ... $this->config->getMock() ? [ 'handler' => HandlerStack::create($this->config->getMock()) ] : [],
        ]);

        try {
            $response = $httpClient->request(
                $request->getVerb()->name,
                $request->getResourceUri(),
                [
                    'form_params' => $request->getData(),
                ]
            );
        } catch (Throwable $throwable) {
            // throw $throwable;
            // TODO: Handle different exception types (4xx 5xx, other)
        }

        return $this->handleResponse($response, $request);
    }

    protected function handleResponse(ResponseInterface $response, BaseRequest $request): BaseResponse
    {
        return $request->createResponseObject(
            json_decode((string) $response->getBody(), true)
        );
    }
}
