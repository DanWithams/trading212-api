<?php

include __DIR__ . '/../vendor/autoload.php';

$client = new \DanWithams\Trading212Api\ClientConfig(
    hostname: 'live.trading212.com',
    secret: '22077901ZHOhCAlNsOjIFSTaeEcXmXydAvUuk'
);

$trading212 = new \DanWithams\Trading212Api\Trading212($client);

var_dump(
    $trading212->fetchPies()
);
