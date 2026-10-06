<?php

declare(strict_types=1);

namespace Chargemap\OCPI\Versions\V2_3_0\Common\Factories;

use Chargemap\OCPI\Versions\V2_3_0\Common\Models\BookingLocation;
use DateTime;
use stdClass;

class BookingLocationFactory
{
    /**
     * @param stdClass[]|null $json
     * @return BookingLocation[]|null
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

    public static function fromJson(?stdClass $json): ?BookingLocation
    {
        if ($json === null) {
            return null;
        }

        $object = new BookingLocation(
            $json->country_code,
            $json->party_id,
            $json->id,
            $json->location_id,
            new DateTime($json->last_updated),
            BookingOptionFactory::fromJson($json->booking_option ?? null),
            PolicyFactory::fromJson($json->policy ?? null),
            BookingTermsFactory::fromJson($json->booking_terms ?? null)
        );

        foreach ($json->tariff_ids ?? [] as $item) {
            $object->addTariffId($item);
        }

        foreach ($json->calendars ?? [] as $item) {
            $object->addCalendar(CalendarFactory::fromJson($item));
        }

        return $object;
    }
}
