<?php

namespace DanWithams\Trading212Api;

use Carbon\Carbon;
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

class Trading212
{
    protected Client $client;

    public function __construct(ClientConfig $config)
    {
        $this->client = new Client($config);
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
        int $id,
        string $name,
        DividendCashAction $dividendCashAction,
        Carbon $endDate,
        float $goal,
        Icon $icon,
        array $instrumentShares = []
    ): UpdatePieResponse
    {
        $response = $this->client->sendRequest(
            new UpdatePie(
                id: $id,
                name: $name,
                dividendCashAction: $dividendCashAction,
                endDate: $endDate,
                goal: $goal,
                icon: $icon,
                instrumentShares: $instrumentShares
            )
        );

        if (! ($response instanceof UpdatePieResponse)) {
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
