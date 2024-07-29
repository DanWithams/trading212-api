<?php

namespace DanWithams\Trading212Api\Requests\Equity;

use Carbon\Carbon;
use DanWithams\Trading212Api\Enums\DividendCashAction;
use DanWithams\Trading212Api\Enums\HttpVerb;
use DanWithams\Trading212Api\Enums\Icon;
use DanWithams\Trading212Api\Models\Equity\Pie;
use DanWithams\Trading212Api\Models\Equity\PieSummary;
use DanWithams\Trading212Api\Requests\BaseRequest;
use Psr\Http\Message\ResponseInterface;

class UpdatePie extends BaseRequest
{
    protected int $id;

    public function __construct(
        protected Pie|PieSummary|int $pie,
        protected ?string $name = null,
        protected ?DividendCashAction $dividendCashAction = null,
        protected ?Carbon $endDate = null,
        protected ?float $goal = null,
        protected ?Icon $icon = null,
        protected ?array $instrumentShares = null
    ) {
        $this->id = is_int($pie) ? $pie : $pie->getId();
    }

    public function getVerb(): HttpVerb
    {
        return HttpVerb::POST;
    }

    public function getResourceUri(): string
    {
        return 'equity/pies/' . $this->id;
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
        return json_encode(
            array_filter(
                [
                    'name' => $this->name,
                    'dividendCashAction' => $this->dividendCashAction,
                    'endDate' => $this->endDate?->format('Y-m-d\TH:i:s\Z'),
                    'goal' => $this->goal,
                    'icon' => $this->icon,
                    'instrumentShares' => $this->instrumentShares,
                ],
                fn ($value) => !is_null($value),
            )
        );
    }

    public static function createResponse(ResponseInterface $response)
    {
        var_dump((string) $response->getBody());

        $data = self::parseResponse($response);

        return Pie::hydrateFromApi($data);
    }
}
