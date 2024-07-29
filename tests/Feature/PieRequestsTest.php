<?php

use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Response;
use DanWithams\Trading212Api\Models\Equity\Pie;
use DanWithams\Trading212Api\Models\Equity\PieSummary;
use DanWithams\Trading212Api\Collections\PieCollection;

test('fetch pies', function () {
    $api = createApi();
    $payload = getJsonPayload('fetch-pies');

    $api->client->config->setMock(
        new MockHandler([
            new Response(200, [], $payload),
        ])
    );

    $pies = $api->fetchPies();

    expect($pies)->toBeInstanceOf(PieCollection::class);

    $pie = $pies->first();

    expect($pie)->toBeInstanceOf(PieSummary::class);
});

test('create pie', function () {
    $api = createApi();
    $payload = getJsonPayload('create-pie');

    $api->client->config->setMock(
        new MockHandler([
            new Response(200, [], $payload),
        ])
    );

    $response = $api->createPie(
        name: "My Test Pie",
        dividendCashAction: \DanWithams\Trading212Api\Enums\DividendCashAction::REINVEST,
        endDate: \Carbon\Carbon::parse('2019-08-24 14:15:22'),
        goal: 2000,
        icon: \DanWithams\Trading212Api\Enums\Icon::Home,
        instrumentShares: [
            'AAPL_US_EQ' => 0.5,
            'MSFT_US_EQ' => 0.5
        ],
    );

    expect($response)->toBeInstanceOf(Pie::class);
});

test('delete pie', function () {
    $api = createApi();
    $payload = getJsonPayload('delete-pie');

    $api->client->config->setMock(
        new MockHandler([
            new Response(200, [], $payload),
        ])
    );

    $response = $api->deletePie(pie: 1);

    expect($response)->toBeTrue();
});


test('fetch a pie', function () {
    $api = createApi();
    $payload = getJsonPayload('fetch-pie');

    $api->client->config->setMock(
        new MockHandler([
            new Response(200, [], $payload),
        ])
    );

    $response = $api->fetchPie(pie: 1);

    expect($response)->toBeInstanceOf(Pie::class);
});

// Update Pie currently broken on Trading212
//test('update pie', function () {
//    [$config, $api] = createApi();
//
//    $config->setMock(
//        new MockHandler([
//            new Response(200, [], '{"foo": "bar"}'),
//        ])
//    );
//
//    $response = $api->updatePie(
//        1,
//        name: "My Test Pie",
//        dividendCashAction: \DanWithams\Trading212Api\Enums\DividendCashAction::REINVEST,
//        endDate: \Carbon\Carbon::parse('2019-08-24 14:15:22'),
//        goal: 2000,
//        icon: \DanWithams\Trading212Api\Enums\Icon::Home,
//        instrumentShares: [
//            'AAPL_US_EQ' => 0.5,
//            'MSFT_US_EQ' => 0.5
//        ],
//    );
//
//    expect($response)->toBeInstanceOf(Pie::class);
//});
