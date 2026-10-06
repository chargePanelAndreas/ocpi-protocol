<?php

declare(strict_types=1);

namespace Chargemap\OCPI\Versions\V2_3_0\Common\Models;

use Chargemap\OCPI\Common\Utils\DateTimeFormatter;
use DateTime;
use JsonSerializable;

class ChargingProfile implements JsonSerializable
{
    private ?DateTime $startDateTime;

    private ?int $duration;

    private ChargingRateUnit $chargingRateUnit;

    private ?float $minChargingRate;

    /** @var ChargingProfilePeriod[] */
    private array $chargingProfilePeriod = [];

    public function __construct(
        ChargingRateUnit $chargingRateUnit,
        ?DateTime $startDateTime,
        ?int $duration,
        ?float $minChargingRate
    )
    {
        $this->chargingRateUnit = $chargingRateUnit;
        $this->startDateTime = $startDateTime;
        $this->duration = $duration;
        $this->minChargingRate = $minChargingRate;
    }

    public function getStartDateTime(): ?DateTime
    {
        return $this->startDateTime;
    }

    public function getDuration(): ?int
    {
        return $this->duration;
    }

    public function getChargingRateUnit(): ChargingRateUnit
    {
        return $this->chargingRateUnit;
    }

    public function getMinChargingRate(): ?float
    {
        return $this->minChargingRate;
    }

    /**
     * @return ChargingProfilePeriod[]
     */
    public function getChargingProfilePeriod(): array
    {
        return $this->chargingProfilePeriod;
    }

    public function addChargingProfilePeriod(ChargingProfilePeriod $chargingProfilePeriod): self
    {
        $this->chargingProfilePeriod[] = $chargingProfilePeriod;

        return $this;
    }

    public function jsonSerialize(): array
    {
        $return = [
            'charging_rate_unit' => $this->chargingRateUnit,
        ];

        if ($this->startDateTime !== null) {
            $return['start_date_time'] = DateTimeFormatter::format($this->startDateTime);
        }

        if ($this->duration !== null) {
            $return['duration'] = $this->duration;
        }

        if ($this->minChargingRate !== null) {
            $return['min_charging_rate'] = $this->minChargingRate;
        }

        if (count($this->chargingProfilePeriod) > 0) {
            $return['charging_profile_period'] = $this->chargingProfilePeriod;
        }

        return $return;
    }
}
