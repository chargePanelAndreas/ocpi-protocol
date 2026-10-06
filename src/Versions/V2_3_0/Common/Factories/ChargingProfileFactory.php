<?php

declare(strict_types=1);

namespace Chargemap\OCPI\Versions\V2_3_0\Common\Factories;

use Chargemap\OCPI\Versions\V2_3_0\Common\Models\ChargingProfile;
use Chargemap\OCPI\Versions\V2_3_0\Common\Models\ChargingRateUnit;
use DateTime;
use stdClass;

class ChargingProfileFactory
{
    /**
     * @param stdClass[]|null $json
     * @return ChargingProfile[]|null
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

    public static function fromJson(?stdClass $json): ?ChargingProfile
    {
        if ($json === null) {
            return null;
        }

        $object = new ChargingProfile(
            new ChargingRateUnit($json->charging_rate_unit),
            isset($json->start_date_time) ? new DateTime($json->start_date_time) : null,
            $json->duration ?? null,
            $json->min_charging_rate ?? null
        );

        foreach ($json->charging_profile_period ?? [] as $item) {
            $object->addChargingProfilePeriod(ChargingProfilePeriodFactory::fromJson($item));
        }

        return $object;
    }
}
