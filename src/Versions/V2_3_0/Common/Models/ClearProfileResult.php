<?php

declare(strict_types=1);

namespace Chargemap\OCPI\Versions\V2_3_0\Common\Models;

use JsonSerializable;

class ClearProfileResult implements JsonSerializable
{
    private ChargingProfileResultType $result;

    public function __construct(
        ChargingProfileResultType $result
    )
    {
        $this->result = $result;
    }

    public function getResult(): ChargingProfileResultType
    {
        return $this->result;
    }

    public function jsonSerialize(): array
    {
        $return = [
            'result' => $this->result,
        ];


        return $return;
    }
}
