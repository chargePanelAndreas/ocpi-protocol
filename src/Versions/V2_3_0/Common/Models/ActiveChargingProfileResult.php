<?php

declare(strict_types=1);

namespace Chargemap\OCPI\Versions\V2_3_0\Common\Models;

use JsonSerializable;

class ActiveChargingProfileResult implements JsonSerializable
{
    private ChargingProfileResultType $result;

    private ?ActiveChargingProfile $profile;

    public function __construct(
        ChargingProfileResultType $result,
        ?ActiveChargingProfile $profile
    )
    {
        $this->result = $result;
        $this->profile = $profile;
    }

    public function getResult(): ChargingProfileResultType
    {
        return $this->result;
    }

    public function getProfile(): ?ActiveChargingProfile
    {
        return $this->profile;
    }

    public function jsonSerialize(): array
    {
        $return = [
            'result' => $this->result,
        ];

        if ($this->profile !== null) {
            $return['profile'] = $this->profile;
        }

        return $return;
    }
}
