<?php

use Carbon\Carbon;
use DanWithams\Trading212Api\Collections\ExchangeCollection;
use DanWithams\Trading212Api\Collections\InstrumentsCollection;
use DanWithams\Trading212Api\Collections\TimeEventCollection;
use DanWithams\Trading212Api\Collections\WorkingScheduleCollection;
use DanWithams\Trading212Api\Enums\InstrumentType;
use DanWithams\Trading212Api\Enums\TimeEventType;
use DanWithams\Trading212Api\Models\AccountData\AccountCash;
use DanWithams\Trading212Api\Models\Instrument;
use DanWithams\Trading212Api\Models\InstrumentsMetaData\Exchange;
use DanWithams\Trading212Api\Models\InstrumentsMetaData\TimeEvent;
use DanWithams\Trading212Api\Models\InstrumentsMetaData\WorkingSchedule;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Response;

test('fetch account cash', function () {
    $api = createApi();
    $payload = getJsonPayload('fetch-account-cash');

    $api->client->config->setMock(
        new MockHandler([
            new Response(200, [], $payload),
        ])
    );

    $accountCash = $api->fetchAccountCash();

    expect($accountCash)->toBeInstanceOf(AccountCash::class)
        ->and($accountCash->free)->toBeFloat()
        ->and($accountCash->free)->toEqual(990.0)
        ->and($accountCash->invested)->toBeFloat()
        ->and($accountCash->invested)->toEqual(5000.0)
        ->and($accountCash->pieCash)->toBeFloat()
        ->and($accountCash->pieCash)->toEqual(15.0)
        ->and($accountCash->ppl)->toBeFloat()
        ->and($accountCash->ppl)->toEqual(567.0)
        ->and($accountCash->result)->toBeFloat()
        ->and($accountCash->result)->toEqual(123.0)
        ->and($accountCash->total)->toBeFloat()
        ->and($accountCash->total)->toEqual(9001.0)
        ->and($accountCash->blocked)->toBeFloat()
        ->and($accountCash->blocked)->toEqual(10.0);
});

