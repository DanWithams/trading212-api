<?php

namespace DanWithams\Trading212Api\Requests\Pies;

use DanWithams\Trading212Api\Enums\HttpVerb;
use DanWithams\Trading212Api\Models\Pies\Pie;
use DanWithams\Trading212Api\Models\Pies\PieSummary;
use DanWithams\Trading212Api\Requests\BaseRequest;
use Psr\Http\Message\ResponseInterface;

class DeletePie extends BaseRequest
{
    protected $id;

    public function __construct(protected Pie|PieSummary|int $pie)
    {
        $this->id = is_int($pie) ? $pie : $pie->getId();
    }

    public function getVerb(): HttpVerb
    {
        return HttpVerb::DELETE;
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
        return null;
    }

    public static function createResponse(ResponseInterface $response)
    {
        return true;
    }
}
