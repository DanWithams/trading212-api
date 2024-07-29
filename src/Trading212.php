<?php

namespace DanWithams\Trading212Api;

use Carbon\Carbon;
use DanWithams\Trading212Api\Collections\ExchangeCollection;
use DanWithams\Trading212Api\Collections\InstrumentsCollection;
use DanWithams\Trading212Api\Collections\PieCollection;
use DanWithams\Trading212Api\Enums\DividendCashAction;
use DanWithams\Trading212Api\Enums\Icon;
use DanWithams\Trading212Api\Exceptions\IncorrectResponseException;
use DanWithams\Trading212Api\Models\AccountData\AccountCash;
use DanWithams\Trading212Api\Models\AccountData\AccountMetadata;
use DanWithams\Trading212Api\Models\Pies\Pie;
use DanWithams\Trading212Api\Models\Pies\PieSummary;
use DanWithams\Trading212Api\Requests\AccountData\FetchAccountCash;
use DanWithams\Trading212Api\Requests\AccountData\FetchAccountMetadata;
use DanWithams\Trading212Api\Requests\Pies\CreatePie;
use DanWithams\Trading212Api\Requests\Pies\DeletePie;
use DanWithams\Trading212Api\Requests\Pies\FetchPie;
use DanWithams\Trading212Api\Requests\Pies\FetchPies;
use DanWithams\Trading212Api\Requests\Pies\UpdatePie;
use DanWithams\Trading212Api\Requests\InstrumentsMetaData\FetchExchange;
use DanWithams\Trading212Api\Requests\InstrumentsMetaData\FetchInstruments;

class Trading212
{
    public readonly Client $client;

    public function __construct(Client|ClientConfig $client)
    {
        $this->client = $client instanceof Client ? $client : new Client($client);
    }

    public function fetchExchanges(): ExchangeCollection
    {
        return $this->client->sendRequest(new FetchExchange);
    }

    public function fetchInstruments(): InstrumentsCollection
    {
        return $this->client->sendRequest(new FetchInstruments());
    }

    /**
     * @throws IncorrectResponseException
     */
    public function fetchPies(): PieCollection
    {
        return $this->client->sendRequest(new FetchPies);
    }

    public function createPie(
        string $name,
        DividendCashAction $dividendCashAction,
        Carbon $endDate,
        float $goal,
        Icon $icon,
        array $instrumentShares = []
    ): Pie
    {
        return $this->client->sendRequest(
            new CreatePie(
                name: $name,
                dividendCashAction: $dividendCashAction,
                endDate: $endDate,
                goal: $goal,
                icon: $icon,
                instrumentShares: $instrumentShares
            )
        );
    }

    public function deletePie(Pie|PieSummary|int $pie): bool
    {
        $this->client->sendRequest(new DeletePie($pie));

        return true;
    }

    public function fetchPie(PieSummary|int $pie): Pie
    {
        return $this->client->sendRequest(new FetchPie($pie));
    }

    public function updatePie(
        Pie|PieSummary|int $pie,
        ?string $name = null,
        ?DividendCashAction $dividendCashAction = null,
        ?Carbon $endDate = null,
        ?float $goal = null,
        ?Icon $icon = null,
        ?array $instrumentShares = null
    ): Pie
    {
        return $this->client->sendRequest(
            new UpdatePie(
                pie: $pie,
                name: $name,
                dividendCashAction: $dividendCashAction,
                endDate: $endDate,
                goal: $goal,
                icon: $icon,
                instrumentShares: $instrumentShares
            )
        );
    }

    public function fetchAccountCash(): AccountCash
    {
        return $this->client->sendRequest(new FetchAccountCash);
    }

    public function fetchAccountMetadata(): AccountMetadata
    {
        return $this->client->sendRequest(new FetchAccountMetadata);
    }
}
