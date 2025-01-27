<?php

declare(strict_types=1);

namespace Chargemap\OCPI\Versions\V2_2_1\Common\Models;

use Chargemap\OCPI\Common\Utils\DateTimeFormatter;
use Chargemap\OCPI\Common\Utils\PartialModel;
use DateTime;
use JsonSerializable;

/**
 * @method bool hasId()
 * @method bool hasStandard()
 * @method bool hasFormat()
 * @method bool hasPowerType()
 * @method bool hasMaxVoltage()
 * @method bool hasMaxAmperage()
 * @method bool hasMaxElectricPower()
 * @method bool hasTariffId()
 * @method bool hasTermsAndConditions()
 * @method bool hasLastUpdated()
 * @method self withId(string $id)
 * @method self withStandard(ConnectorType $standard)
 * @method self withFormat(ConnectorFormat $format)
 * @method self withPowerType(PowerType $powerType)
 * @method self withVoltage(int $voltage)
 * @method self withAmperage(int $amperage)
 * @method self withTariffId(?string $tariffId)
 * @method self withTermsAndConditions(?string $termsAndConditions)
 * @method self withLastUpdated(DateTime $lastUpdated)
 */
class PartialConnector extends PartialModel implements JsonSerializable
{
    private ?string $id = null;
    private ?ConnectorType $standard = null;
    private ?ConnectorFormat $format = null;
    private ?PowerType $powerType = null;
    private ?int $maxVoltage = null;
    private ?int $maxAmperage = null;
    private ?int $maxElectricPower = null;
    private ?string $tariffId = null;
    private ?string $termsAndConditions = null;
    private ?DateTime $lastUpdated = null;

    protected function _withId(string $id): self
    {
        $this->id = $id;
        return $this;
    }

    protected function _withStandard(ConnectorType $standard): self
    {
        $this->standard = $standard;
        return $this;
    }

    protected function _withFormat(ConnectorFormat $format): self
    {
        $this->format = $format;
        return $this;
    }

    protected function _withPowerType(PowerType $powerType): self
    {
        $this->powerType = $powerType;
        return $this;
    }

    protected function _withMaxVoltage(int $maxVoltage): self
    {
        $this->maxVoltage = $maxVoltage;
        return $this;
    }

    protected function _withMaxAmperage(int $maxAmperage): self
    {
        $this->maxAmperage = $maxAmperage;
        return $this;
    }

    protected function _withMaxElectricPower(int $maxElectricPower): self
    {
        $this->maxElectricPower = $maxElectricPower;
        return $this;
    }

    protected function _withTariffId(?string $tariffId): self
    {
        $this->tariffId = $tariffId;
        return $this;
    }

    protected function _withTermsAndConditions(?string $termsAndConditions): self
    {
        $this->termsAndConditions = $termsAndConditions;
        return $this;
    }

    protected function _withLastUpdated(DateTime $lastUpdated): self
    {
        $this->lastUpdated = $lastUpdated;
        return $this;
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getStandard(): ?ConnectorType
    {
        return $this->standard;
    }

    public function getFormat(): ?ConnectorFormat
    {
        return $this->format;
    }

    public function getPowerType(): ?PowerType
    {
        return $this->powerType;
    }

    public function getMaxVoltage(): ?int
    {
        return $this->maxVoltage;
    }

    public function getMaxAmperage(): ?int
    {
        return $this->maxAmperage;
    }

    public function getMaxElectricPower(): ?int
    {
        return $this->maxElectricPower;
    }

    public function getTariffId(): ?string
    {
        return $this->tariffId;
    }

    public function getTermsAndConditions(): ?string
    {
        return $this->termsAndConditions;
    }

    public function getLastUpdated(): ?DateTime
    {
        return $this->lastUpdated;
    }

    public function jsonSerialize(): array
    {
        $return = [];

        if ($this->hasId()) {
            $return['id'] = $this->id;
        }
        if ($this->hasStandard()) {
            $return['standard'] = $this->standard;
        }
        if ($this->hasFormat()) {
            $return['format'] = $this->format;
        }
        if ($this->hasPowerType()) {
            $return['power_type'] = $this->powerType;
        }
        if ($this->hasMaxVoltage()) {
            $return['max_voltage'] = $this->maxVoltage;
        }
        if ($this->hasMaxAmperage()) {
            $return['max_amperage'] = $this->maxAmperage;
        }
        if ($this->hasMaxElectricPower()) {
            $return['max_electric_power'] = $this->max_electric_power;
        }
        if ($this->hasTariffId()) {
            $return['tariff_id'] = $this->tariffId;
        }
        if ($this->hasTermsAndConditions()) {
            $return['terms_and_conditions'] = $this->termsAndConditions;
        }
        if ($this->hasLastUpdated()) {
            $return['last_updated'] = DateTimeFormatter::format($this->lastUpdated);
        }

        return $return;
    }
}
