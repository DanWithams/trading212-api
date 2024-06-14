# Trading212 PHP API Client and Library

This package aims to provide a similar Library and a more detailed Client for the Trading212 API

Official Trading212 API documentation can be found here https://t212public-api-docs.redoc.ly/ or check their website for updates.

## Installation
To install this package via the `composer require` command:

```bash
$ composer require danwithams/trading212-api
```

## PHP Library

There is simple PHP Class which can be instantiate with the appropriate config which will provide concrete methods for each API resource. This Library is recommended if you are a beginner to medium level developer

```php
use DanWithams\Trading212Api\ClientConfig;

$config = new ClientConfig(
    hostname: 'demo.trading212.com',
    secret: 'abcd-efgh-ijkl-mnop',
);
```

## PHP Client

The API Client exposes more classes to you to allow you to do more with this library. Recommended for advanced developers.

```php
use DanWithams\Trading212Api\Client;
use DanWithams\Trading212Api\Requests\EquityCreatePie;

$client = new Client($config); // $config is the same from the previous example 

$createPieResponse = $client->sendRequest(
    new CreatePie(
        name: $name,
        dividendCashAction: $dividendCashAction,
        endDate: $endDate,
        goal: $goal,
        icon: $icon,
        instrumentShares: $instrumentShares
    )
);

$fetchPieResponse = $client->sendRequest(
    new new FetchPie(1)
);
```

## PHP Client
