<?php

declare(strict_types=1);

namespace Chargemap\OCPI\Versions\V2_3_0\Common\Factories;

use Chargemap\OCPI\Versions\V2_3_0\Common\Models\SetChargingProfile;
use stdClass;

class SetChargingProfileFactory
{
    /**
     * @param stdClass[]|null $json
     * @return SetChargingProfile[]|null
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

    public static function fromJson(?stdClass $json): ?SetChargingProfile
    {
        if ($json === null) {
            return null;
        }

        $object = new SetChargingProfile(
            ChargingProfileFactory::fromJson($json->charging_profile),
            $json->response_url
        );

        return $object;
    }
}
