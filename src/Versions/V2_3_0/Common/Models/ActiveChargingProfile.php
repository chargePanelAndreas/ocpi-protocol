<?php

declare(strict_types=1);

namespace Chargemap\OCPI\Versions\V2_3_0\Common\Models;

use Chargemap\OCPI\Common\Utils\DateTimeFormatter;
use DateTime;
use JsonSerializable;

class ActiveChargingProfile implements JsonSerializable
{
    private DateTime $startDateTime;

    private ChargingProfile $chargingProfile;

    public function __construct(
        DateTime $startDateTime,
        ChargingProfile $chargingProfile
    )
    {
        $this->startDateTime = $startDateTime;
        $this->chargingProfile = $chargingProfile;
    }

    public function getStartDateTime(): DateTime
    {
        return $this->startDateTime;
    }

    public function getChargingProfile(): ChargingProfile
    {
        return $this->chargingProfile;
    }

    public function jsonSerialize(): array
    {
        $return = [
            'start_date_time' => DateTimeFormatter::format($this->startDateTime),
            'charging_profile' => $this->chargingProfile,
        ];


        return $return;
    }
}
