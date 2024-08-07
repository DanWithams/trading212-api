<?php

use Carbon\Carbon;
use DanWithams\Trading212Api\Collections\InstrumentsCollection;
use DanWithams\Trading212Api\Enums\DividendCashAction;
use DanWithams\Trading212Api\Enums\Icon;
use DanWithams\Trading212Api\Models\DividendDetails;
use DanWithams\Trading212Api\Models\Pies\PieResult;
use DanWithams\Trading212Api\Models\Pies\PieSettings;
use DanWithams\Trading212Api\Models\Instrument;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Response;
use DanWithams\Trading212Api\Models\Pies\Pie;
use DanWithams\Trading212Api\Models\Pies\PieSummary;
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

    expect($pies)->toBeInstanceOf(PieCollection::class)
        ->and($pies->first())->toBeInstanceOf(PieSummary::class)
        ->and($pies->first()->id)->toBeInt()
        ->and($pies->first()->id)->toEqual(548841)
        ->and($pies->first()->cash)->toBeFloat()
        ->and($pies->first()->cash)->toEqual(0.0)
        ->and($pies->first()->progress)->toBeNull()
        ->and($pies->first()->status)->toBeNull()
        ->and($pies->first()->dividendDetails)->toBeInstanceOf(DividendDetails::class)
        ->and($pies->first()->dividendDetails->gained)->toBeFloat()
        ->and($pies->first()->dividendDetails->gained)->toEqual(0.0)
        ->and($pies->first()->dividendDetails->reinvested)->toBeFloat()
        ->and($pies->first()->dividendDetails->reinvested)->toEqual(0.0)
        ->and($pies->first()->dividendDetails->inCash)->toBeFloat()
        ->and($pies->first()->dividendDetails->inCash)->toEqual(0.0)
        ->and($pies->first()->result)->toBeInstanceOf(PieResult::class)
        ->and($pies->first()->result->investedValue)->toBeFloat()
        ->and($pies->first()->result->investedValue)->toEqual(99.68)
        ->and($pies->first()->result->result)->toBeFloat()
        ->and($pies->first()->result->result)->toEqual(1.31)
        ->and($pies->first()->result->resultCoefficient)->toBeFloat()
        ->and($pies->first()->result->resultCoefficient)->toEqual(0.0131)
        ->and($pies->first()->result->value)->toBeFloat()
        ->and($pies->first()->result->value)->toEqual(100.99);
});

test('create pie', function () {
    $api = createApi();
    $payload = getJsonPayload('create-pie');

    $api->client->config->setMock(
        new MockHandler([
            new Response(200, [], $payload),
        ])
    );

    $pie = $api->createPie(
        name: "My Test Pie",
        dividendCashAction: DividendCashAction::REINVEST,
        endDate: Carbon::parse('2019-08-24 14:15:22'),
        goal: 2000,
        icon: Icon::Home,
        instrumentShares: [
            'AAPL_US_EQ' => 0.5,
            'MSFT_US_EQ' => 0.5
        ],
    );

    expect($pie)->toBeInstanceOf(Pie::class)
        ->and($pie->instruments)->toBeInstanceOf(InstrumentsCollection::class)
        ->and($pie->instruments->first())->toBeInstanceOf(Instrument::class)
        ->and($pie->instruments->first()->ticker)->toBeString('AAPL_US_EQ')
        ->and($pie->instruments->get(1)->ticker)->toBeString('MSFT_US_EQ')
        ->and($pie->settings)->toBeInstanceOf(PieSettings::class)
        ->and($pie->settings->id)->toBeInt()
        ->and($pie->settings->id)->toEqual(584735)
        ->and($pie->settings->name)->toBeString()
        ->and($pie->settings->name)->toEqual('My Test Pie')
        ->and($pie->settings->dividendCashAction)->toEqual(DividendCashAction::REINVEST)
        ->and($pie->settings->goal)->toBeFloat()
        ->and($pie->settings->goal)->toEqual(2000)
        ->and($pie->settings->icon)->toEqual(Icon::Home)
        ->and($pie->settings->creationDate)->toBeInstanceOf(Carbon::class)
        ->and($pie->settings->creationDate)->toEqual(Carbon::parse('2024-07-04T23:59:59.999000+0300'))
    ;
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

    $pie = $api->fetchPie(pie: 1);

    expect($pie)->toBeInstanceOf(Pie::class)
        ->and($pie->instruments)->toBeInstanceOf(InstrumentsCollection::class)
        ->and($pie->instruments->first())->toBeInstanceOf(Instrument::class)
        ->and($pie->instruments->first()->ticker)->toBeString()
        ->and($pie->instruments->first()->ticker)->toEqual('AIRp_EQ')
        ->and($pie->instruments->get(1)->ticker)->toBeString()
        ->and($pie->instruments->get(1)->ticker)->toEqual('RHMd_EQ')
        ->and($pie->settings)->toBeInstanceOf(PieSettings::class)
        ->and($pie->settings->id)->toBeInt()
        ->and($pie->settings->id)->toEqual(548841)
        ->and($pie->settings->name)->toBeString()
        ->and($pie->settings->name)->toEqual('My Test Pie')
        ->and($pie->settings->dividendCashAction)->toEqual(DividendCashAction::REINVEST)
        ->and($pie->settings->goal)->toBeNull()
        ->and($pie->settings->icon)->toBeNull()
        ->and($pie->settings->creationDate)->toBeInstanceOf(Carbon::class)
        ->and($pie->settings->creationDate)->toEqual(Carbon::parse('2024-03-05T23:59:59.999000+0300'));
});

// Update Pie currently broken on Trading212
//test('update pie', function () {
//    $api = createApi();
//    $payload = getJsonPayload('fetch-pie');
//
//    $api->client->config->setMock(
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
