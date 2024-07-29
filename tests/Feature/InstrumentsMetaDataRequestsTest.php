<?php

use Carbon\Carbon;
use DanWithams\Trading212Api\Collections\ExchangeCollection;
use DanWithams\Trading212Api\Collections\TimeEventCollection;
use DanWithams\Trading212Api\Collections\WorkingScheduleCollection;
use DanWithams\Trading212Api\Enums\TimeEventType;
use DanWithams\Trading212Api\Models\InstrumentsMetaData\Exchange;
use DanWithams\Trading212Api\Models\InstrumentsMetaData\TimeEvent;
use DanWithams\Trading212Api\Models\InstrumentsMetaData\WorkingSchedule;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Response;

test('fetch exchanges', function () {
    $api = createApi();
    $payload = getJsonPayload('fetch-exchange-list');

    $api->client->config->setMock(
        new MockHandler([
            new Response(200, [], $payload),
        ])
    );

    $exchanges = $api->fetchExchangeList();

    expect($exchanges)->toBeInstanceOf(ExchangeCollection::class)
        ->and($exchanges->first())->toBeInstanceOf(Exchange::class)
        ->and($exchanges->first()->workingSchedules)->toBeInstanceOf(WorkingScheduleCollection::class)
        ->and($exchanges->first()->workingSchedules->first())->toBeInstanceOf(WorkingSchedule::class)
        ->and($exchanges->first()->workingSchedules->first()->timeEvents)->toBeInstanceOf(TimeEventCollection::class)
        ->and($exchanges->first()->workingSchedules->first()->timeEvents->first())->toBeInstanceOf(TimeEvent::class)
        ->and($exchanges->first()->workingSchedules->first()->timeEvents->first()->date)->toBeInstanceOf(Carbon::class)
        ->and($exchanges->first()->workingSchedules->first()->timeEvents->first()->date)->toEqual(Carbon::parse('2024-07-15 07:00:00'))
        ->and($exchanges->first()->workingSchedules->first()->timeEvents->get(1)->date)->toEqual(Carbon::parse('2024-07-15 15:30:00'))
        ->and($exchanges->first()->workingSchedules->first()->timeEvents->first()->type)->toBeIn(TimeEventType::cases())
        ->and($exchanges->first()->workingSchedules->first()->timeEvents->get(1)->type)->toBeIn(TimeEventType::cases());
});
