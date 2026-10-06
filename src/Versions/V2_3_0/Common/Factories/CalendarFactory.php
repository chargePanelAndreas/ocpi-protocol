<?php

declare(strict_types=1);

namespace Chargemap\OCPI\Versions\V2_3_0\Common\Factories;

use Chargemap\OCPI\Versions\V2_3_0\Common\Models\Calendar;
use DateTime;
use stdClass;

class CalendarFactory
{
    /**
     * @param stdClass[]|null $json
     * @return Calendar[]|null
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

    public static function fromJson(?stdClass $json): ?Calendar
    {
        if ($json === null) {
            return null;
        }

        $availableTimeslots = [];
        foreach ($json->available_timeslots as $item) {
            $availableTimeslots[] = TimeslotFactory::fromJson($item);
        }

        $object = new Calendar(
            $json->id,
            new DateTime($json->begin_from),
            new DateTime($json->end_before),
            $availableTimeslots,
            new DateTime($json->last_updated),
            $json->timeslot_increment ?? null
        );

        return $object;
    }
}
