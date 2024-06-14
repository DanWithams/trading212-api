<?php

include __DIR__ . '/../vendor/autoload.php';

$client = new \DanWithams\Trading212Api\ClientConfig(
    hostname: 'demo.trading212.com',
    secret: '--'
);

$trading212 = new \DanWithams\Trading212Api\Trading212($client);

var_dump(
    $trading212->fetchPies()
);
