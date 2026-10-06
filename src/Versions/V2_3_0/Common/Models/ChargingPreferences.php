<?php

declare(strict_types=1);

namespace Chargemap\OCPI\Versions\V2_3_0\Common\Models;


use Chargemap\OCPI\Common\Utils\DateTimeFormatter;
use DateTime;
use JsonSerializable;

class ChargingPreferences implements JsonSerializable
{
    private ProfileType $profileType;

    private ?DateTime $departureTime;

    private ?float $energyNeed;

    private ?bool $dischargeAllowed;

    public function __construct(
        ProfileType $profileType,
        ?DateTime $departureTime,
        ?float $energyNeed,
        ?bool $dischargeAllowed
    )
    {
        $this->profileType = $profileType;
        $this->departureTime = $departureTime;
        $this->energyNeed = $energyNeed;
        $this->dischargeAllowed = $dischargeAllowed;
    }

    public function getProfileType(): ProfileType
    {
        return $this->profileType;
    }

    public function getDepartureTime(): ?DateTime
    {
        return $this->departureTime;
    }

    public function getEnergyNeed(): ?float
    {
        return $this->energyNeed;
    }

    public function getDischargeAllowed(): ?bool
    {
        return $this->dischargeAllowed;
    }

    public function jsonSerialize(): array
    {
        $return = [
            'profile_type' => $this->profileType,
        ];

        if ($this->departureTime) {
            $return['departure_time'] = DateTimeFormatter::format($this->departureTime);
        };

        if ($this->energyNeed !== null) {
            $return['energy_need'] = $this->energyNeed;
        }

        if ($this->dischargeAllowed !== null) {
            $return['discharge_allowed'] = $this->dischargeAllowed;
        }

        return $return;
    }
}
