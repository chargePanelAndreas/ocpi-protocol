<?php

declare(strict_types=1);

namespace Chargemap\OCPI\Versions\V2_3_0\Common\Factories;

use Chargemap\OCPI\Versions\V2_3_0\Common\Models\Timeslot;
use DateTime;
use stdClass;

class TimeslotFactory
{
    /**
     * @param stdClass[]|null $json
     * @return Timeslot[]|null
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

    public static function fromJson(?stdClass $json): ?Timeslot
    {
        if ($json === null) {
            return null;
        }

        $object = new Timeslot(
            new DateTime($json->start_date_time),
            new DateTime($json->end_date_time),
            $json->min_power ?? null,
            $json->max_power ?? null,
            $json->green_energy_support ?? null
        );

        return $object;
    }
}
