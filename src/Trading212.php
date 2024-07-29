<?php

namespace DanWithams\Trading212Api;

use Carbon\Carbon;
use DanWithams\Trading212Api\Collections\ExchangeCollection;
use DanWithams\Trading212Api\Collections\InstrumentsCollection;
use DanWithams\Trading212Api\Collections\PieCollection;
use DanWithams\Trading212Api\Enums\DividendCashAction;
use DanWithams\Trading212Api\Enums\Icon;
use DanWithams\Trading212Api\Exceptions\IncorrectResponseException;
use DanWithams\Trading212Api\Models\Equity\Pie;
use DanWithams\Trading212Api\Models\Equity\PieSummary;
use DanWithams\Trading212Api\Requests\Equity\CreatePie;
use DanWithams\Trading212Api\Requests\Equity\DeletePie;
use DanWithams\Trading212Api\Requests\Equity\FetchPie;
use DanWithams\Trading212Api\Requests\Equity\FetchPies;
use DanWithams\Trading212Api\Requests\Equity\UpdatePie;
use DanWithams\Trading212Api\Requests\InstrumentsMetaData\FetchExchangeList;
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
        $response = $this->client->sendRequest(new FetchExchangeList);

        if (! ($response instanceof ExchangeCollection)) {
            $this->throwBadResponseException();
        }

        return $response;
    }

    public function fetchInstruments(): InstrumentsCollection
    {
        $response = $this->client->sendRequest(new FetchInstruments());

        if (! ($response instanceof InstrumentsCollection)) {
            $this->throwBadResponseException();
        }

        return $response;
    }

    /**
     * @throws IncorrectResponseException
     */
    public function fetchPies(): PieCollection
    {
        $response = $this->client->sendRequest(new FetchPies);

        if (! ($response instanceof PieCollection)) {
            $this->throwBadResponseException();
        }

        return $response;
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
        $response = $this->client->sendRequest(
            new CreatePie(
                name: $name,
                dividendCashAction: $dividendCashAction,
                endDate: $endDate,
                goal: $goal,
                icon: $icon,
                instrumentShares: $instrumentShares
            )
        );

        if (! ($response instanceof Pie)) {
            $this->throwBadResponseException();
        }

        return $response;
    }

    public function deletePie(Pie|PieSummary|int $pie): bool
    {
        $this->client->sendRequest(new DeletePie($pie));

        return true;
    }

    public function fetchPie(PieSummary|int $pie): Pie
    {
        $response = $this->client->sendRequest(new FetchPie($pie));

        if (! ($response instanceof Pie)) {
            $this->throwBadResponseException();
        }

        return $response;
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
        $response = $this->client->sendRequest(
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

        if (! ($response instanceof Pie)) {
            $this->throwBadResponseException();
        }

        return $response;
    }

    /**
     * @throws IncorrectResponseException
     */
    protected function throwBadResponseException(): never
    {
        throw new IncorrectResponseException();
    }
}
