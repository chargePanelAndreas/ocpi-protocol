<?php

declare(strict_types=1);

namespace Chargemap\OCPI\Versions\V2_3_0\Common\Factories;

use Chargemap\OCPI\Versions\V2_3_0\Common\Models\ActiveChargingProfileResult;
use Chargemap\OCPI\Versions\V2_3_0\Common\Models\ChargingProfileResultType;
use stdClass;

class ActiveChargingProfileResultFactory
{
    /**
     * @param stdClass[]|null $json
     * @return ActiveChargingProfileResult[]|null
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

    public static function fromJson(?stdClass $json): ?ActiveChargingProfileResult
    {
        if ($json === null) {
            return null;
        }

        $object = new ActiveChargingProfileResult(
            new ChargingProfileResultType($json->result),
            ActiveChargingProfileFactory::fromJson($json->profile ?? null)
        );

        return $object;
    }
}
