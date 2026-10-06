<?php

declare(strict_types=1);

namespace Chargemap\OCPI\Versions\V2_3_0\Common\Factories;

use Chargemap\OCPI\Versions\V2_3_0\Common\Models\ChargingProfileResponse;
use Chargemap\OCPI\Versions\V2_3_0\Common\Models\ChargingProfileResponseType;
use stdClass;

class ChargingProfileResponseFactory
{
    /**
     * @param stdClass[]|null $json
     * @return ChargingProfileResponse[]|null
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

    public static function fromJson(?stdClass $json): ?ChargingProfileResponse
    {
        if ($json === null) {
            return null;
        }

        $object = new ChargingProfileResponse(
            new ChargingProfileResponseType($json->result),
            $json->timeout
        );

        return $object;
    }
}
