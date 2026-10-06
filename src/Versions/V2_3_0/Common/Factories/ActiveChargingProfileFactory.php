<?php

declare(strict_types=1);

namespace Chargemap\OCPI\Versions\V2_3_0\Common\Factories;

use Chargemap\OCPI\Versions\V2_3_0\Common\Models\ActiveChargingProfile;
use DateTime;
use stdClass;

class ActiveChargingProfileFactory
{
    /**
     * @param stdClass[]|null $json
     * @return ActiveChargingProfile[]|null
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

    public static function fromJson(?stdClass $json): ?ActiveChargingProfile
    {
        if ($json === null) {
            return null;
        }

        $object = new ActiveChargingProfile(
            new DateTime($json->start_date_time),
            ChargingProfileFactory::fromJson($json->charging_profile)
        );

        return $object;
    }
}
