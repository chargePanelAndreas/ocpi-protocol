<?php

declare(strict_types=1);

namespace Chargemap\OCPI\Versions\V2_3_0\Common\Factories;

use Chargemap\OCPI\Versions\V2_3_0\Common\Models\BookingOption;
use Chargemap\OCPI\Versions\V2_3_0\Common\Models\ConnectorFormat;
use Chargemap\OCPI\Versions\V2_3_0\Common\Models\ConnectorType;
use Chargemap\OCPI\Versions\V2_3_0\Common\Models\EVSEPosition;
use Chargemap\OCPI\Versions\V2_3_0\Common\Models\PowerType;
use Chargemap\OCPI\Versions\V2_3_0\Common\Models\VehicleType;
use stdClass;

class BookingOptionFactory
{
    /**
     * @param stdClass[]|null $json
     * @return BookingOption[]|null
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

    public static function fromJson(?stdClass $json): ?BookingOption
    {
        if ($json === null) {
            return null;
        }

        $object = new BookingOption(
            $json->evse_uid ?? null,
            $json->connector_id ?? null,
            $json->parking_id ?? null,
            $json->max_vehicle_weight ?? null,
            $json->max_vehicle_height ?? null,
            $json->max_vehicle_length ?? null,
            $json->max_vehicle_width ?? null,
            $json->min_parking_space_length ?? null,
            $json->min_parking_space_width ?? null,
            $json->dangerous_goods_allowed ?? null,
            $json->drive_through ?? null,
            $json->refrigeration_outlet ?? null
        );

        foreach ($json->evse_position ?? [] as $item) {
            $object->addEvsePosition(new EVSEPosition($item));
        }

        foreach ($json->vehicle_types ?? [] as $item) {
            $object->addVehicleType(new VehicleType($item));
        }

        foreach ($json->connector_format ?? [] as $item) {
            $object->addConnectorFormat(new ConnectorFormat($item));
        }

        foreach ($json->connector_types ?? [] as $item) {
            $object->addConnectorType(new ConnectorType($item));
        }

        foreach ($json->power_types ?? [] as $item) {
            $object->addPowerType(new PowerType($item));
        }

        return $object;
    }
}
