<?php

declare(strict_types=1);

namespace Chargemap\OCPI\Versions\V2_3_0\Common\Models;

use JsonSerializable;

class Parking implements JsonSerializable
{
    private string $id;

    private ?string $physicalReference;

    /** @var VehicleType[] */
    private array $vehicleTypes;

    private ?float $maxVehicleWeight;

    private ?float $maxVehicleHeight;

    private ?float $maxVehicleLength;

    private ?float $maxVehicleWidth;

    private ?float $parkingSpaceLength;

    private ?float $parkingSpaceWidth;

    private ?bool $dangerousGoodsAllowed;

    private ?ParkingDirection $direction;

    private ?bool $driveThrough;

    private bool $restrictedToType;

    private bool $reservationRequired;

    private ?float $timeLimit;

    private ?bool $roofed;

    /** @var Image[] */
    private array $images = [];

    private ?bool $lighting;

    private ?bool $refrigerationOutlet;

    /** @var string[] */
    private array $standards = [];

    private ?string $apdsReference;

    public function __construct(
        string $id,
        array $vehicleTypes,
        bool $restrictedToType,
        bool $reservationRequired,
        ?string $physicalReference,
        ?float $maxVehicleWeight,
        ?float $maxVehicleHeight,
        ?float $maxVehicleLength,
        ?float $maxVehicleWidth,
        ?float $parkingSpaceLength,
        ?float $parkingSpaceWidth,
        ?bool $dangerousGoodsAllowed,
        ?ParkingDirection $direction,
        ?bool $driveThrough,
        ?float $timeLimit,
        ?bool $roofed,
        ?bool $lighting,
        ?bool $refrigerationOutlet,
        ?string $apdsReference
    )
    {
        $this->id = $id;
        $this->vehicleTypes = $vehicleTypes;
        $this->restrictedToType = $restrictedToType;
        $this->reservationRequired = $reservationRequired;
        $this->physicalReference = $physicalReference;
        $this->maxVehicleWeight = $maxVehicleWeight;
        $this->maxVehicleHeight = $maxVehicleHeight;
        $this->maxVehicleLength = $maxVehicleLength;
        $this->maxVehicleWidth = $maxVehicleWidth;
        $this->parkingSpaceLength = $parkingSpaceLength;
        $this->parkingSpaceWidth = $parkingSpaceWidth;
        $this->dangerousGoodsAllowed = $dangerousGoodsAllowed;
        $this->direction = $direction;
        $this->driveThrough = $driveThrough;
        $this->timeLimit = $timeLimit;
        $this->roofed = $roofed;
        $this->lighting = $lighting;
        $this->refrigerationOutlet = $refrigerationOutlet;
        $this->apdsReference = $apdsReference;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getPhysicalReference(): ?string
    {
        return $this->physicalReference;
    }

    /**
     * @return VehicleType[]
     */
    public function getVehicleTypes(): array
    {
        return $this->vehicleTypes;
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

    public function getParkingSpaceLength(): ?float
    {
        return $this->parkingSpaceLength;
    }

    public function getParkingSpaceWidth(): ?float
    {
        return $this->parkingSpaceWidth;
    }

    public function getDangerousGoodsAllowed(): ?bool
    {
        return $this->dangerousGoodsAllowed;
    }

    public function getDirection(): ?ParkingDirection
    {
        return $this->direction;
    }

    public function getDriveThrough(): ?bool
    {
        return $this->driveThrough;
    }

    public function getRestrictedToType(): bool
    {
        return $this->restrictedToType;
    }

    public function getReservationRequired(): bool
    {
        return $this->reservationRequired;
    }

    public function getTimeLimit(): ?float
    {
        return $this->timeLimit;
    }

    public function getRoofed(): ?bool
    {
        return $this->roofed;
    }

    /**
     * @return Image[]
     */
    public function getImages(): array
    {
        return $this->images;
    }

    public function addImage(Image $image): self
    {
        $this->images[] = $image;

        return $this;
    }

    public function getLighting(): ?bool
    {
        return $this->lighting;
    }

    public function getRefrigerationOutlet(): ?bool
    {
        return $this->refrigerationOutlet;
    }

    /**
     * @return string[]
     */
    public function getStandards(): array
    {
        return $this->standards;
    }

    public function addStandard(string $standard): self
    {
        $this->standards[] = $standard;

        return $this;
    }

    public function getApdsReference(): ?string
    {
        return $this->apdsReference;
    }

    public function jsonSerialize(): array
    {
        $return = [
            'id' => $this->id,
            'vehicle_types' => $this->vehicleTypes,
            'restricted_to_type' => $this->restrictedToType,
            'reservation_required' => $this->reservationRequired,
        ];

        if ($this->physicalReference !== null) {
            $return['physical_reference'] = $this->physicalReference;
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

        if ($this->parkingSpaceLength !== null) {
            $return['parking_space_length'] = $this->parkingSpaceLength;
        }

        if ($this->parkingSpaceWidth !== null) {
            $return['parking_space_width'] = $this->parkingSpaceWidth;
        }

        if ($this->dangerousGoodsAllowed !== null) {
            $return['dangerous_goods_allowed'] = $this->dangerousGoodsAllowed;
        }

        if ($this->direction !== null) {
            $return['direction'] = $this->direction;
        }

        if ($this->driveThrough !== null) {
            $return['drive_through'] = $this->driveThrough;
        }

        if ($this->timeLimit !== null) {
            $return['time_limit'] = $this->timeLimit;
        }

        if ($this->roofed !== null) {
            $return['roofed'] = $this->roofed;
        }

        if (count($this->images) > 0) {
            $return['images'] = $this->images;
        }

        if ($this->lighting !== null) {
            $return['lighting'] = $this->lighting;
        }

        if ($this->refrigerationOutlet !== null) {
            $return['refrigeration_outlet'] = $this->refrigerationOutlet;
        }

        if (count($this->standards) > 0) {
            $return['standards'] = $this->standards;
        }

        if ($this->apdsReference !== null) {
            $return['apds_reference'] = $this->apdsReference;
        }

        return $return;
    }
}
