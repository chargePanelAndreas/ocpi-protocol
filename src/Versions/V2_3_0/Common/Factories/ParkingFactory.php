<?php

declare(strict_types=1);

namespace Chargemap\OCPI\Versions\V2_3_0\Common\Factories;

use Chargemap\OCPI\Versions\V2_3_0\Common\Models\Parking;
use Chargemap\OCPI\Versions\V2_3_0\Common\Models\ParkingDirection;
use Chargemap\OCPI\Versions\V2_3_0\Common\Models\VehicleType;
use stdClass;

class ParkingFactory
{
    /**
     * @param stdClass[]|null $json
     * @return Parking[]|null
     */
    public static function arrayFromJsonArray(?array $json): ?array
    {
        if ($json === null) {
            return null;
        }

        $objects = [];
        foreach ($json as $jsonObject) {
            $objects[] = self::fromJson($jsonObject);
        }

        return $objects;
    }

    public static function fromJson(?stdClass $json): ?Parking
    {
        if ($json === null) {
            return null;
        }

        $vehicleTypes = [];
        foreach ($json->vehicle_types as $item) {
            $vehicleTypes[] = new VehicleType($item);
        }

        $object = new Parking(
            $json->id,
            $vehicleTypes,
            $json->restricted_to_type,
            $json->reservation_required,
            $json->physical_reference ?? null,
            $json->max_vehicle_weight ?? null,
            $json->max_vehicle_height ?? null,
            $json->max_vehicle_length ?? null,
            $json->max_vehicle_width ?? null,
            $json->parking_space_length ?? null,
            $json->parking_space_width ?? null,
            $json->dangerous_goods_allowed ?? null,
            isset($json->direction) ? new ParkingDirection($json->direction) : null,
            $json->drive_through ?? null,
            $json->time_limit ?? null,
            $json->roofed ?? null,
            $json->lighting ?? null,
            $json->refrigeration_outlet ?? null,
            $json->apds_reference ?? null
        );

        foreach ($json->images ?? [] as $item) {
            $object->addImage(ImageFactory::fromJson($item));
        }

        foreach ($json->standards ?? [] as $item) {
            $object->addStandard($item);
        }

        return $object;
    }
}
