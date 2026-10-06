<?php

declare(strict_types=1);

namespace Chargemap\OCPI\Versions\V2_3_0\Common\Models;

use JsonSerializable;

class ChargingProfilePeriod implements JsonSerializable
{
    private int $startPeriod;

    private float $limit;

    public function __construct(
        int $startPeriod,
        float $limit
    )
    {
        $this->startPeriod = $startPeriod;
        $this->limit = $limit;
    }

    public function getStartPeriod(): int
    {
        return $this->startPeriod;
    }

    public function getLimit(): float
    {
        return $this->limit;
    }

    public function jsonSerialize(): array
    {
        $return = [
            'start_period' => $this->startPeriod,
            'limit' => $this->limit,
        ];


        return $return;
    }
}
