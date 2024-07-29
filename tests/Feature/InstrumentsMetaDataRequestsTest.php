<?php

use Carbon\Carbon;
use DanWithams\Trading212Api\Collections\ExchangeCollection;
use DanWithams\Trading212Api\Collections\InstrumentsCollection;
use DanWithams\Trading212Api\Collections\TimeEventCollection;
use DanWithams\Trading212Api\Collections\WorkingScheduleCollection;
use DanWithams\Trading212Api\Enums\InstrumentType;
use DanWithams\Trading212Api\Enums\TimeEventType;
use DanWithams\Trading212Api\Models\Instrument;
use DanWithams\Trading212Api\Models\InstrumentsMetaData\Exchange;
use DanWithams\Trading212Api\Models\InstrumentsMetaData\TimeEvent;
use DanWithams\Trading212Api\Models\InstrumentsMetaData\WorkingSchedule;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Response;

test('fetch exchanges', function () {
    $api = createApi();
    $payload = getJsonPayload('fetch-exchange');

    $api->client->config->setMock(
        new MockHandler([
            new Response(200, [], $payload),
        ])
    );

    $exchanges = $api->fetchExchanges();

    expect($exchanges)->toBeInstanceOf(ExchangeCollection::class)
        ->and($exchanges->first())->toBeInstanceOf(Exchange::class)
        ->and($exchanges)->toHaveCount(16)
        ->and($exchanges->first()->workingSchedules)->toBeInstanceOf(WorkingScheduleCollection::class)
        ->and($exchanges->first()->workingSchedules)->toHaveCount(1)
        ->and($exchanges->first()->workingSchedules->first())->toBeInstanceOf(WorkingSchedule::class)
        ->and($exchanges->first()->workingSchedules->first()->timeEvents)->toBeInstanceOf(TimeEventCollection::class)
        ->and($exchanges->first()->workingSchedules->first()->timeEvents)->toHaveCount(60)
        ->and($exchanges->first()->workingSchedules->first()->timeEvents->first())->toBeInstanceOf(TimeEvent::class)
        ->and($exchanges->first()->workingSchedules->first()->timeEvents->first()->date)->toBeInstanceOf(Carbon::class)
        ->and($exchanges->first()->workingSchedules->first()->timeEvents->first()->date)->toEqual(Carbon::parse('2024-07-15 07:00:00'))
        ->and($exchanges->first()->workingSchedules->first()->timeEvents->get(1)->date)->toEqual(Carbon::parse('2024-07-15 15:30:00'))
        ->and($exchanges->first()->workingSchedules->first()->timeEvents->first()->type)->toBeIn(TimeEventType::cases())
        ->and($exchanges->first()->workingSchedules->first()->timeEvents->get(1)->type)->toBeIn(TimeEventType::cases());
});

test('fetch instruments', function () {
    $api = createApi();
    $payload = getJsonPayload('fetch-instruments');

    $api->client->config->setMock(
        new MockHandler([
            new Response(200, [], $payload),
        ])
    );

    $instruments = $api->fetchInstruments();

    var_dump($instruments->first());

    expect($instruments)->toBeInstanceOf(InstrumentsCollection::class)
        ->and($instruments)->toHaveCount(13924)
        ->and($instruments->first())->toBeInstanceOf(Instrument::class)
        ->and($instruments->first()->ticker)->toBeString('STN_US_EQ')
        ->and($instruments->first()->type)->toEqual(InstrumentType::STOCK)
        ->and($instruments->first()->workingScheduleId)->toBeInt(56)
    ;
});
