<?php

declare(strict_types=1);

namespace Chargemap\OCPI\Versions\V2_3_0\Common\Factories;

use Chargemap\OCPI\Versions\V2_3_0\Common\Models\PartialCalendar;
use DateTime;
use stdClass;

class PartialCalendarFactory
{
    public static function fromJson(?stdClass $json): ?PartialCalendar
    {
        if ($json === null) {
            return null;
        }

        $object = new PartialCalendar();

        if (property_exists($json, 'begin_from')) {
            $object->withBeginFrom($json->begin_from === null ? null : new DateTime($json->begin_from));
        }
        if (property_exists($json, 'end_before')) {
            $object->withEndBefore($json->end_before === null ? null : new DateTime($json->end_before));
        }
        if (property_exists($json, 'timeslot_increment')) {
            $object->withTimeslotIncrement($json->timeslot_increment);
        }
        if (property_exists($json, 'available_timeslots')) {
            $items = [];
            foreach ($json->available_timeslots ?? [] as $item) {
                $items[] = TimeslotFactory::fromJson($item);
            }
            $object->withAvailableTimeslots($items);
        }
        if (property_exists($json, 'last_updated')) {
            $object->withLastUpdated($json->last_updated === null ? null : new DateTime($json->last_updated));
        }

        return $object;
    }
}
