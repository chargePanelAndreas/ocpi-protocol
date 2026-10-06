<?php

declare(strict_types=1);

namespace Chargemap\OCPI\Versions\V2_3_0\Common\Factories;

use Chargemap\OCPI\Versions\V2_3_0\Common\Models\EVSEParking;
use Chargemap\OCPI\Versions\V2_3_0\Common\Models\EVSEPosition;
use stdClass;

class EVSEParkingFactory
{
    /**
     * @param stdClass[]|null $json
     * @return EVSEParking[]|null
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

    public static function fromJson(?stdClass $json): ?EVSEParking
    {
        if ($json === null) {
            return null;
        }

        $object = new EVSEParking(
            $json->parking_id,
            isset($json->evse_position) ? new EVSEPosition($json->evse_position) : null
        );

        return $object;
    }
}
