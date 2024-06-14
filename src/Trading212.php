<?php

namespace DanWithams\Trading212Api;

use Carbon\Carbon;
use DanWithams\Trading212Api\Enums\DividendCashAction;
use DanWithams\Trading212Api\Enums\Icon;
use DanWithams\Trading212Api\Exceptions\IncorrectResponseException;
use DanWithams\Trading212Api\Requests\Equity\CreatePie;
use DanWithams\Trading212Api\Requests\Equity\DeletePie;
use DanWithams\Trading212Api\Requests\Equity\FetchPie;
use DanWithams\Trading212Api\Requests\Equity\FetchPies;
use DanWithams\Trading212Api\Requests\Equity\UpdatePie;
use DanWithams\Trading212Api\Responses\FetchPies as FetchPiesResponse;
use DanWithams\Trading212Api\Responses\CreatePie as CreatePieResponse;
use DanWithams\Trading212Api\Responses\DeletePie as DeletePieResponse;
use DanWithams\Trading212Api\Responses\FetchPie as FetchPieResponse;
use DanWithams\Trading212Api\Responses\UpdatePie as UpdatePieResponse;

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
    public function fetchPies(): FetchPiesResponse
    {
        $response = $this->client->sendRequest(new FetchPies);

        if (! ($response instanceof FetchPiesResponse)) {
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
    ): CreatePieResponse
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

        if (! ($response instanceof CreatePieResponse)) {
            $this->throwBadResponseException();
        }

        return $response;
    }

    public function deletePie(int $id)
    {
        $response = $this->client->sendRequest(new DeletePie($id));

        if (! ($response instanceof DeletePieResponse)) {
            $this->throwBadResponseException();
        }

        return $response;
    }

    public function fetchPie(int $id)
    {
        $response = $this->client->sendRequest(new FetchPie($id));

        if (! ($response instanceof FetchPieResponse)) {
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
