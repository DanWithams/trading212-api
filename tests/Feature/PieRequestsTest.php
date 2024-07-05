<?php

use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Response;
use DanWithams\Trading212Api\Models\Equity\Pie;
use DanWithams\Trading212Api\Models\Equity\PieSummary;
use DanWithams\Trading212Api\Collections\PieCollection;

test('fetch all pies', function () {
    [$config, $api] = createApi();

    $config->setMock(
        new MockHandler([
            new Response(200, [], '[{"id":548841,"cash":0.00,"dividendDetails":{"gained":0.00,"reinvested":0.00,"inCash":0.00},"result":{"investedValue":99.68,"value":100.99,"result":1.31,"resultCoef":0.0131},"progress":null,"status":null}]'),
        ])
    );

    $pies = $api->fetchPies();

    expect($pies)->toBeInstanceOf(PieCollection::class);

    $pie = $pies->first();

    expect($pie)->toBeInstanceOf(PieSummary::class);
});

test('create pie', function () {
    [$config, $api] = createApi();

    $config->setMock(
        new MockHandler([
            new Response(200, [], '{"instruments":[{"ticker":"AAPL_US_EQ","result":{"investedValue":0,"value":0,"result":0,"resultCoef":0},"expectedShare":0.5,"currentShare":0,"ownedQuantity":0,"issues":[]},{"ticker":"MSFT_US_EQ","result":{"investedValue":0,"value":0,"result":0,"resultCoef":0},"expectedShare":0.5,"currentShare":0,"ownedQuantity":0,"issues":[]}],"settings":{"id":584735,"instrumentShares":null,"name":"My Test Pie","icon":"Home","goal":2000,"creationDate":"2024-07-04T23:59:59.999+03:00","endDate":"2019-08-24T23:59:59.999+03:00","initialInvestment":null,"dividendCashAction":"REINVEST","publicUrl":null}}'),
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
    [$config, $api] = createApi();

    $config->setMock(
        new MockHandler([
            new Response(200, [], '{}'),
        ])
    );

    $response = $api->deletePie(pie: 1);

    expect($response)->toBeTrue();
});


test('fetch a pie', function () {
    [$config, $api] = createApi();

    $config->setMock(
        new MockHandler([
            new Response(200, [], '{"instruments":[{"ticker":"AIRp_EQ","result":{"investedValue":12.98,"value":11.20,"result":-1.78,"resultCoef":-0.1371},"expectedShare":0.1300,"currentShare":0.1108,"ownedQuantity":0.0972557000,"issues":[]},{"ticker":"RHMd_EQ","result":{"investedValue":12.98,"value":15.46,"result":2.48,"resultCoef":0.1911},"expectedShare":0.1300,"currentShare":0.1529,"ownedQuantity":0.0352670000,"issues":[]},{"ticker":"HOp_EQ","result":{"investedValue":12.94,"value":13.83,"result":0.89,"resultCoef":0.0688},"expectedShare":0.1300,"currentShare":0.1368,"ownedQuantity":0.1043213000,"issues":[]},{"ticker":"FINMY_US_EQ","result":{"investedValue":12.98,"value":13.70,"result":0.72,"resultCoef":0.0555},"expectedShare":0.1300,"currentShare":0.1355,"ownedQuantity":1.4505990000,"issues":[]},{"ticker":"BAl_EQ","result":{"investedValue":11.94,"value":12.21,"result":0.27,"resultCoef":0.0226},"expectedShare":0.1200,"currentShare":0.1208,"ownedQuantity":0.9483953900,"issues":[]},{"ticker":"DSYp_EQ","result":{"investedValue":11.94,"value":9.73,"result":-2.21,"resultCoef":-0.1851},"expectedShare":0.1200,"currentShare":0.0962,"ownedQuantity":0.3264100000,"issues":[]},{"ticker":"BABl_EQ","result":{"investedValue":11.94,"value":12.35,"result":0.41,"resultCoef":0.0343},"expectedShare":0.1200,"currentShare":0.1221,"ownedQuantity":2.3738166000,"issues":[]},{"ticker":"HAGd_EQ","result":{"investedValue":11.98,"value":12.63,"result":0.65,"resultCoef":0.0543},"expectedShare":0.1200,"currentShare":0.1249,"ownedQuantity":0.4116630000,"issues":[]}],"settings":{"id":548841,"instrumentShares":null,"name":"Defence","icon":null,"goal":null,"creationDate":"2024-03-05T23:59:59.999+03:00","endDate":null,"initialInvestment":null,"dividendCashAction":"REINVEST","publicUrl":null}}'),
        ])
    );

    $response = $api->fetchPie(pie: 1);

    expect($response)->toBeInstanceOf(Pie::class);
});

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
//    expect($response)->toBeInstanceOf(\DanWithams\Trading212Api\Responses\UpdatePie::class);
//});
