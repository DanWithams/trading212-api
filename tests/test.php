<?php

include __DIR__ . '/../vendor/autoload.php';

$client = new \DanWithams\Trading212Api\ClientConfig(
    hostname: 'demo.trading212.com',
    secret: '31075972ZVoXGzfjnMWnCBEVzgFUqjBqZFiva'
);

$trading212 = new \DanWithams\Trading212Api\Trading212($client);

var_dump(
    $pies = $trading212->fetchPies()
);

//$pie = $trading212->createPie(
//    name: "My Test Pie",
//    dividendCashAction: \DanWithams\Trading212Api\Enums\DividendCashAction::REINVEST,
//    endDate: \Carbon\Carbon::parse('2019-08-24 14:15:22'),
//    goal: 2000,
//    icon: \DanWithams\Trading212Api\Enums\Icon::Home,
//    instrumentShares: [
//        'AAPL_US_EQ' => 0.5,
//        'MSFT_US_EQ' => 0.5
//    ],
//);
//
//var_dump($pie);

//$trading212->deletePie(584742);

var_dump(
    $trading212->updatePie($pies->first(), 'New Name 123')
);
