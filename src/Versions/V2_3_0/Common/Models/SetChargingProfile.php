<?php

declare(strict_types=1);

namespace Chargemap\OCPI\Versions\V2_3_0\Common\Models;

use JsonSerializable;

class SetChargingProfile implements JsonSerializable
{
    private ChargingProfile $chargingProfile;

    private string $responseUrl;

    public function __construct(
        ChargingProfile $chargingProfile,
        string $responseUrl
    )
    {
        $this->chargingProfile = $chargingProfile;
        $this->responseUrl = $responseUrl;
    }

    public function getChargingProfile(): ChargingProfile
    {
        return $this->chargingProfile;
    }

    public function getResponseUrl(): string
    {
        return $this->responseUrl;
    }

    public function jsonSerialize(): array
    {
        $return = [
            'charging_profile' => $this->chargingProfile,
            'response_url' => $this->responseUrl,
        ];


        return $return;
    }
}
