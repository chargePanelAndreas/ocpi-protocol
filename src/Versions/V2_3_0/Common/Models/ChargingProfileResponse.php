<?php

declare(strict_types=1);

namespace Chargemap\OCPI\Versions\V2_3_0\Common\Models;

use JsonSerializable;

class ChargingProfileResponse implements JsonSerializable
{
    private ChargingProfileResponseType $result;

    private int $timeout;

    public function __construct(
        ChargingProfileResponseType $result,
        int $timeout
    )
    {
        $this->result = $result;
        $this->timeout = $timeout;
    }

    public function getResult(): ChargingProfileResponseType
    {
        return $this->result;
    }

    public function getTimeout(): int
    {
        return $this->timeout;
    }

    public function jsonSerialize(): array
    {
        $return = [
            'result' => $this->result,
            'timeout' => $this->timeout,
        ];


        return $return;
    }
}
