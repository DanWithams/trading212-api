<?php

include __DIR__ . '/../vendor/autoload.php';

$client = new \DanWithams\Trading212Api\ClientConfig(
    hostname: 'demo.trading212.com',
    secret: '31075972ZVoXGzfjnMWnCBEVzgFUqjBqZFiva'
);

$trading212 = new \DanWithams\Trading212Api\Trading212($client);

$exchanges = $trading212->fetchInstruments();


