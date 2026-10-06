<?php

declare(strict_types=1);

namespace Chargemap\OCPI\Versions\V2_3_0\Common\Models;

use JsonSerializable;

class BookingOption implements JsonSerializable
{
    private ?string $evseUid;

    private ?string $connectorId;

    private ?string $parkingId;

    /** @var EVSEPosition[] */
    private array $evsePosition = [];

    /** @var VehicleType[] */
    private array $vehicleTypes = [];

    /** @var ConnectorFormat[] */
    private array $connectorFormat = [];

    /** @var ConnectorType[] */
    private array $connectorTypes = [];

    /** @var PowerType[] */
    private array $powerTypes = [];

    private ?float $maxVehicleWeight;

    private ?float $maxVehicleHeight;

    private ?float $maxVehicleLength;

    private ?float $maxVehicleWidth;

    private ?float $minParkingSpaceLength;

    private ?float $minParkingSpaceWidth;

    private ?bool $dangerousGoodsAllowed;

    private ?bool $driveThrough;

    private ?bool $refrigerationOutlet;

    public function __construct(
        ?string $evseUid,
        ?string $connectorId,
        ?string $parkingId,
        ?float $maxVehicleWeight,
        ?float $maxVehicleHeight,
        ?float $maxVehicleLength,
        ?float $maxVehicleWidth,
        ?float $minParkingSpaceLength,
        ?float $minParkingSpaceWidth,
        ?bool $dangerousGoodsAllowed,
        ?bool $driveThrough,
        ?bool $refrigerationOutlet
    )
    {
        $this->evseUid = $evseUid;
        $this->connectorId = $connectorId;
        $this->parkingId = $parkingId;
        $this->maxVehicleWeight = $maxVehicleWeight;
        $this->maxVehicleHeight = $maxVehicleHeight;
        $this->maxVehicleLength = $maxVehicleLength;
        $this->maxVehicleWidth = $maxVehicleWidth;
        $this->minParkingSpaceLength = $minParkingSpaceLength;
        $this->minParkingSpaceWidth = $minParkingSpaceWidth;
        $this->dangerousGoodsAllowed = $dangerousGoodsAllowed;
        $this->driveThrough = $driveThrough;
        $this->refrigerationOutlet = $refrigerationOutlet;
    }

    public function getEvseUid(): ?string
    {
        return $this->evseUid;
    }

    public function getConnectorId(): ?string
    {
        return $this->connectorId;
    }

    public function getParkingId(): ?string
    {
        return $this->parkingId;
    }

    /**
     * @return EVSEPosition[]
     */
    public function getEvsePosition(): array
    {
        return $this->evsePosition;
    }

    public function addEvsePosition(EVSEPosition $evsePosition): self
    {
        $this->evsePosition[] = $evsePosition;

        return $this;
    }

    /**
     * @return VehicleType[]
     */
    public function getVehicleTypes(): array
    {
        return $this->vehicleTypes;
    }

    public function addVehicleType(VehicleType $vehicleType): self
    {
        $this->vehicleTypes[] = $vehicleType;

        return $this;
    }

    /**
     * @return ConnectorFormat[]
     */
    public function getConnectorFormat(): array
    {
        return $this->connectorFormat;
    }

    public function addConnectorFormat(ConnectorFormat $connectorFormat): self
    {
        $this->connectorFormat[] = $connectorFormat;

        return $this;
    }

    /**
     * @return ConnectorType[]
     */
    public function getConnectorTypes(): array
    {
        return $this->connectorTypes;
    }

    public function addConnectorType(ConnectorType $connectorType): self
    {
        $this->connectorTypes[] = $connectorType;

        return $this;
    }

    /**
     * @return PowerType[]
     */
    public function getPowerTypes(): array
    {
        return $this->powerTypes;
    }

    public function addPowerType(PowerType $powerType): self
    {
        $this->powerTypes[] = $powerType;

        return $this;
    }

    public function getMaxVehicleWeight(): ?float
    {
        return $this->maxVehicleWeight;
    }

    public function getMaxVehicleHeight(): ?float
    {
        return $this->maxVehicleHeight;
    }

    public function getMaxVehicleLength(): ?float
    {
        return $this->maxVehicleLength;
    }

    public function getMaxVehicleWidth(): ?float
    {
        return $this->maxVehicleWidth;
    }

    public function getMinParkingSpaceLength(): ?float
    {
        return $this->minParkingSpaceLength;
    }

    public function getMinParkingSpaceWidth(): ?float
    {
        return $this->minParkingSpaceWidth;
    }

    public function getDangerousGoodsAllowed(): ?bool
    {
        return $this->dangerousGoodsAllowed;
    }

    public function getDriveThrough(): ?bool
    {
        return $this->driveThrough;
    }

    public function getRefrigerationOutlet(): ?bool
    {
        return $this->refrigerationOutlet;
    }

    public function jsonSerialize(): array
    {
        $return = [];

        if ($this->evseUid !== null) {
            $return['evse_uid'] = $this->evseUid;
        }

        if ($this->connectorId !== null) {
            $return['connector_id'] = $this->connectorId;
        }

        if ($this->parkingId !== null) {
            $return['parking_id'] = $this->parkingId;
        }

        if (count($this->evsePosition) > 0) {
            $return['evse_position'] = $this->evsePosition;
        }

        if (count($this->vehicleTypes) > 0) {
            $return['vehicle_types'] = $this->vehicleTypes;
        }

        if (count($this->connectorFormat) > 0) {
            $return['connector_format'] = $this->connectorFormat;
        }

        if (count($this->connectorTypes) > 0) {
            $return['connector_types'] = $this->connectorTypes;
        }

        if (count($this->powerTypes) > 0) {
            $return['power_types'] = $this->powerTypes;
        }

        if ($this->maxVehicleWeight !== null) {
            $return['max_vehicle_weight'] = $this->maxVehicleWeight;
        }

        if ($this->maxVehicleHeight !== null) {
            $return['max_vehicle_height'] = $this->maxVehicleHeight;
        }

        if ($this->maxVehicleLength !== null) {
            $return['max_vehicle_length'] = $this->maxVehicleLength;
        }

        if ($this->maxVehicleWidth !== null) {
            $return['max_vehicle_width'] = $this->maxVehicleWidth;
        }

        if ($this->minParkingSpaceLength !== null) {
            $return['min_parking_space_length'] = $this->minParkingSpaceLength;
        }

        if ($this->minParkingSpaceWidth !== null) {
            $return['min_parking_space_width'] = $this->minParkingSpaceWidth;
        }

        if ($this->dangerousGoodsAllowed !== null) {
            $return['dangerous_goods_allowed'] = $this->dangerousGoodsAllowed;
        }

        if ($this->driveThrough !== null) {
            $return['drive_through'] = $this->driveThrough;
        }

        if ($this->refrigerationOutlet !== null) {
            $return['refrigeration_outlet'] = $this->refrigerationOutlet;
        }

        return $return;
    }
}
