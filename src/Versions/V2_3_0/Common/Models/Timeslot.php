<?php

declare(strict_types=1);

namespace Chargemap\OCPI\Versions\V2_3_0\Common\Models;

use Chargemap\OCPI\Common\Utils\DateTimeFormatter;
use DateTime;
use JsonSerializable;

class Timeslot implements JsonSerializable
{
    private DateTime $startDateTime;

    private DateTime $endDateTime;

    private ?float $minPower;

    private ?float $maxPower;

    private ?bool $greenEnergySupport;

    public function __construct(
        DateTime $startDateTime,
        DateTime $endDateTime,
        ?float $minPower,
        ?float $maxPower,
        ?bool $greenEnergySupport
    )
    {
        $this->startDateTime = $startDateTime;
        $this->endDateTime = $endDateTime;
        $this->minPower = $minPower;
        $this->maxPower = $maxPower;
        $this->greenEnergySupport = $greenEnergySupport;
    }

    public function getStartDateTime(): DateTime
    {
        return $this->startDateTime;
    }

    public function getEndDateTime(): DateTime
    {
        return $this->endDateTime;
    }

    public function getMinPower(): ?float
    {
        return $this->minPower;
    }

    public function getMaxPower(): ?float
    {
        return $this->maxPower;
    }

    public function getGreenEnergySupport(): ?bool
    {
        return $this->greenEnergySupport;
    }

    public function jsonSerialize(): array
    {
        $return = [
            'start_date_time' => DateTimeFormatter::format($this->startDateTime),
            'end_date_time' => DateTimeFormatter::format($this->endDateTime),
        ];

        if ($this->minPower !== null) {
            $return['min_power'] = $this->minPower;
        }

        if ($this->maxPower !== null) {
            $return['max_power'] = $this->maxPower;
        }

        if ($this->greenEnergySupport !== null) {
            $return['green_energy_support'] = $this->greenEnergySupport;
        }

        return $return;
    }
}
