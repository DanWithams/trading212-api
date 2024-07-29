<?php

include __DIR__ . '/../vendor/autoload.php';

$client = new \DanWithams\Trading212Api\ClientConfig(
    hostname: 'demo.trading212.com',
    secret: '31075972ZVoXGzfjnMWnCBEVzgFUqjBqZFiva'
);

$trading212 = new \DanWithams\Trading212Api\Trading212($client);


$pies = $trading212->fetchPies();

var_dump($pies->first()->getId());

try {

    $response = $trading212->updatePie(
        $pies->first()->getId(),
        name: "My Test Pie 4",
        dividendCashAction: \DanWithams\Trading212Api\Enums\DividendCashAction::REINVEST,
        endDate: \Carbon\Carbon::parse('2019-08-24 14:15:22'),
        goal: 2000,
        icon: \DanWithams\Trading212Api\Enums\Icon::Home,
        instrumentShares: [
            'AAPL_US_EQ' => 0.5,
            'MSFT_US_EQ' => 0.5
        ],
    );

} catch (\Exception $e) {
    print (string) $e->getResponse()->getBody();
}