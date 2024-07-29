<?php

namespace DanWithams\Trading212Api\Requests\Equity;

use Carbon\Carbon;
use DanWithams\Trading212Api\Enums\DividendCashAction;
use DanWithams\Trading212Api\Enums\HttpVerb;
use DanWithams\Trading212Api\Enums\Icon;
use DanWithams\Trading212Api\Models\Equity\Pie;
use DanWithams\Trading212Api\Requests\BaseRequest;
use Psr\Http\Message\ResponseInterface;

class CreatePie extends BaseRequest
{
    public function __construct(
        protected string $name,
        protected DividendCashAction $dividendCashAction,
        protected Carbon $endDate,
        protected float $goal,
        protected Icon $icon,
        protected array $instrumentShares = []
    ) {

    }

    public function getVerb(): HttpVerb
    {
        return HttpVerb::POST;
    }

    public function getResourceUri(): string
    {
        return 'equity/pies';
    }

    public function getParams(): array
    {
        return [];
    }

    public function getData(): array
    {
        return [];
    }

    public function getBody(): ?string
    {
        return json_encode([
            'name' => $this->name,
            'dividendCashAction' => $this->dividendCashAction->name,
            'endDate' => $this->endDate->format('Y-m-d\TH:i:s\Z'),
            'goal' => $this->goal,
            'icon' => $this->icon->name,
            'instrumentShares' => $this->instrumentShares,
        ]);
    }

    public static function createResponse(ResponseInterface $response)
    {
        $data = self::parseResponse($response);

        return Pie::hydrateFromApi($data);
    }
}
