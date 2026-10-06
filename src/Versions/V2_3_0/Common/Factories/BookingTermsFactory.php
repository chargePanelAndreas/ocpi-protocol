<?php

declare(strict_types=1);

namespace Chargemap\OCPI\Versions\V2_3_0\Common\Factories;

use Chargemap\OCPI\Versions\V2_3_0\Common\Models\BookingTerms;
use Chargemap\OCPI\Versions\V2_3_0\Common\Models\AccessMethod;
use stdClass;

class BookingTermsFactory
{
    /**
     * @param stdClass[]|null $json
     * @return BookingTerms[]|null
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

    public static function fromJson(?stdClass $json): ?BookingTerms
    {
        if ($json === null) {
            return null;
        }

        $supportedAccessMethods = [];
        foreach ($json->supported_access_methods as $item) {
            $supportedAccessMethods[] = new AccessMethod($item);
        }

        $object = new BookingTerms(
            $supportedAccessMethods,
            $json->change_until_minutes,
            $json->cancel_until_minutes,
            $json->rfid_auth_required ?? null,
            $json->token_groups_supported ?? null,
            $json->remote_auth_supported ?? null,
            $json->change_not_allowed ?? null,
            $json->early_start_allowed ?? null,
            $json->early_start_time ?? null,
            $json->noshow_timeout ?? null,
            $json->noshow_fee ?? null,
            $json->late_stop_allowed ?? null,
            $json->late_stop_time ?? null,
            $json->overlapping_bookings_allowed ?? null,
            $json->min_booking_duration ?? null,
            $json->max_booking_duration ?? null,
            $json->booking_terms ?? null
        );

        return $object;
    }
}
