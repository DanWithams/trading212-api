<?php

namespace DanWithams\Trading212Api;

use DanWithams\Trading212Api\Requests\BaseRequest;
use GuzzleHttp\Client as Guzzle;
use Psr\Http\Message\ResponseInterface;
use Throwable;
//use GuzzleHttp\Handler\CurlHandler;
//use GuzzleHttp\HandlerStack;
//use GuzzleHttp\Middleware;
//use GuzzleHttp\Psr7\Response;

class Client
{
    public function __construct(public ClientConfig $config)
    {

    }

    protected function generateBaseUri(): string
    {
        return $this->config->getProtocol() . '://' . $this->config->getHostname(withPort: true) . '/api/v0/';
    }

    public function sendRequest(BaseRequest $request): array
    {
//        $stack = new HandlerStack();
//        $stack->setHandler(new CurlHandler());
//        $stack->push(
//            Middleware::mapResponse(function (ResponseInterface $response) {
//                return $response->withHeader('X-Foo', 'bar');
//            })
//        );

        $httpClient = new Guzzle([
            'base_uri' => $this->generateBaseUri(),
            'headers' => [
                'Authorization' => $this->config->getSecret(),
            ],
//            'handler' => $stack,
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
            throw $throwable;
        }

        return $this->handleResponse($response);
    }

    protected function handleResponse(ResponseInterface $response): array
    {
        return json_decode($response->getBody(), true);
    }
}
