<?php

declare(strict_types=1);

namespace Chargemap\OCPI\Versions\V2_3_0\Common\Factories;

use Chargemap\OCPI\Versions\V2_3_0\Common\Models\PartialBookingLocation;
use DateTime;
use stdClass;

class PartialBookingLocationFactory
{
    public static function fromJson(?stdClass $json): ?PartialBookingLocation
    {
        if ($json === null) {
            return null;
        }

        $object = new PartialBookingLocation();

        if (property_exists($json, 'booking_option')) {
            $object->withBookingOption(BookingOptionFactory::fromJson($json->booking_option));
        }
        if (property_exists($json, 'policy')) {
            $object->withPolicy(PolicyFactory::fromJson($json->policy));
        }
        if (property_exists($json, 'tariff_ids')) {
            $items = [];
            foreach ($json->tariff_ids ?? [] as $item) {
                $items[] = $item;
            }
            $object->withTariffIds($items);
        }
        if (property_exists($json, 'booking_terms')) {
            $object->withBookingTerms(BookingTermsFactory::fromJson($json->booking_terms));
        }
        if (property_exists($json, 'calendars')) {
            $items = [];
            foreach ($json->calendars ?? [] as $item) {
                $items[] = CalendarFactory::fromJson($item);
            }
            $object->withCalendars($items);
        }
        if (property_exists($json, 'last_updated')) {
            $object->withLastUpdated($json->last_updated === null ? null : new DateTime($json->last_updated));
        }

        return $object;
    }
}
