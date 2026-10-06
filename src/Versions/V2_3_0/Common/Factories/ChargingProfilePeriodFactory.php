<?php

declare(strict_types=1);

namespace Chargemap\OCPI\Versions\V2_3_0\Common\Factories;

use Chargemap\OCPI\Versions\V2_3_0\Common\Models\ChargingProfilePeriod;
use stdClass;

class ChargingProfilePeriodFactory
{
    /**
     * @param stdClass[]|null $json
     * @return ChargingProfilePeriod[]|null
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

    public static function fromJson(?stdClass $json): ?ChargingProfilePeriod
    {
        if ($json === null) {
            return null;
        }

        $object = new ChargingProfilePeriod(
            $json->start_period,
            $json->limit
        );

        return $object;
    }
}
