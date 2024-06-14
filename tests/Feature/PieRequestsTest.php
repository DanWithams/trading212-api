<?php

test('fetch all pies', function () {
    [$config, $api] = createApi();

    $config->setMock(
        new \GuzzleHttp\Handler\MockHandler([
            new \GuzzleHttp\Psr7\Response(200, [], '{"foo": "bar"}'),
        ])
    );

    $response = $api->fetchPies();

    expect($response)->toBeInstanceOf(\DanWithams\Trading212Api\Responses\FetchPies::class);
});

test('create pie', function () {
    [$config, $api] = createApi();

    $config->setMock(
        new \GuzzleHttp\Handler\MockHandler([
            new \GuzzleHttp\Psr7\Response(200, [], '{"foo": "bar"}'),
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

    expect($response)->toBeInstanceOf(\DanWithams\Trading212Api\Responses\CreatePie::class);
});

test('delete pie', function () {
    [$config, $api] = createApi();

    $config->setMock(
        new \GuzzleHttp\Handler\MockHandler([
            new \GuzzleHttp\Psr7\Response(200, [], '{"foo": "bar"}'),
        ])
    );

    $response = $api->deletePie(id: 1);

    expect($response)->toBeInstanceOf(\DanWithams\Trading212Api\Responses\DeletePie::class);
});

test('fetch a pie', function () {
    [$config, $api] = createApi();

    $config->setMock(
        new \GuzzleHttp\Handler\MockHandler([
            new \GuzzleHttp\Psr7\Response(200, [], '{"foo": "bar"}'),
        ])
    );

    $response = $api->fetchPie(id: 1);

    expect($response)->toBeInstanceOf(\DanWithams\Trading212Api\Responses\FetchPie::class);
});

test('update pie', function () {
    [$config, $api] = createApi();

    $config->setMock(
        new \GuzzleHttp\Handler\MockHandler([
            new \GuzzleHttp\Psr7\Response(200, [], '{"foo": "bar"}'),
        ])
    );

    $response = $api->updatePie(
        1,
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

    expect($response)->toBeInstanceOf(\DanWithams\Trading212Api\Responses\UpdatePie::class);
});
