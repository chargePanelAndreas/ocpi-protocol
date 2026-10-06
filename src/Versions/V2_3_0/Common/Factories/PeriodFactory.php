<?php

declare(strict_types=1);

namespace Chargemap\OCPI\Versions\V2_3_0\Common\Factories;

use Chargemap\OCPI\Versions\V2_3_0\Common\Models\Period;
use DateTime;
use stdClass;

class PeriodFactory
{
    /**
     * @param stdClass[]|null $json
     * @return Period[]|null
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

    public static function fromJson(?stdClass $json): ?Period
    {
        if ($json === null) {
            return null;
        }

        $object = new Period(
            new DateTime($json->start_date_time),
            new DateTime($json->end_date_time)
        );

        return $object;
    }
}
