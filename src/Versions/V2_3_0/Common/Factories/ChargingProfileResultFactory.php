<?php

declare(strict_types=1);

namespace Chargemap\OCPI\Versions\V2_3_0\Common\Factories;

use Chargemap\OCPI\Versions\V2_3_0\Common\Models\ChargingProfileResult;
use Chargemap\OCPI\Versions\V2_3_0\Common\Models\ChargingProfileResultType;
use stdClass;

class ChargingProfileResultFactory
{
    /**
     * @param stdClass[]|null $json
     * @return ChargingProfileResult[]|null
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

    public static function fromJson(?stdClass $json): ?ChargingProfileResult
    {
        if ($json === null) {
            return null;
        }

        $object = new ChargingProfileResult(
            new ChargingProfileResultType($json->result)
        );

        return $object;
    }
}
