<?php

declare(strict_types=1);

namespace Chargemap\OCPI\Versions\V2_3_0\Common\Factories;

use Chargemap\OCPI\Versions\V2_3_0\Common\Models\ClearProfileResult;
use Chargemap\OCPI\Versions\V2_3_0\Common\Models\ChargingProfileResultType;
use stdClass;

class ClearProfileResultFactory
{
    /**
     * @param stdClass[]|null $json
     * @return ClearProfileResult[]|null
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

    public static function fromJson(?stdClass $json): ?ClearProfileResult
    {
        if ($json === null) {
            return null;
        }

        $object = new ClearProfileResult(
            new ChargingProfileResultType($json->result)
        );

        return $object;
    }
}
