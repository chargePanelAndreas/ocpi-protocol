<?php

declare(strict_types=1);

namespace Chargemap\OCPI\Versions\V2_3_0\Common\Factories;

use Chargemap\OCPI\Versions\V2_3_0\Common\Models\PartialBooking;
use Chargemap\OCPI\Versions\V2_3_0\Common\Models\ReservationStatus;
use DateTime;
use stdClass;

class PartialBookingFactory
{
    public static function fromJson(?stdClass $json): ?PartialBooking
    {
        if ($json === null) {
            return null;
        }

        $object = new PartialBooking();

        if (property_exists($json, 'booking_option')) {
            $object->withBookingOption(BookingOptionFactory::fromJson($json->booking_option));
        }
        if (property_exists($json, 'location_id')) {
            $object->withLocationId($json->location_id);
        }
        if (property_exists($json, 'booking_tokens')) {
            $items = [];
            foreach ($json->booking_tokens ?? [] as $item) {
                $items[] = BookingTokenFactory::fromJson($item);
            }
            $object->withBookingTokens($items);
        }
        if (property_exists($json, 'tariff_ids')) {
            $items = [];
            foreach ($json->tariff_ids ?? [] as $item) {
                $items[] = $item;
            }
            $object->withTariffIds($items);
        }
        if (property_exists($json, 'period')) {
            $object->withPeriod(TimeslotFactory::fromJson($json->period));
        }
        if (property_exists($json, 'reservation_status')) {
            $object->withReservationStatus($json->reservation_status === null ? null : new ReservationStatus($json->reservation_status));
        }
        if (property_exists($json, 'canceled')) {
            $object->withCanceled(CancellationFactory::fromJson($json->canceled));
        }
        if (property_exists($json, 'access_information')) {
            $items = [];
            foreach ($json->access_information ?? [] as $item) {
                $items[] = AccessInformationFactory::fromJson($item);
            }
            $object->withAccessInformation($items);
        }
        if (property_exists($json, 'authorization_reference')) {
            $object->withAuthorizationReference($json->authorization_reference);
        }
        if (property_exists($json, 'booking_terms')) {
            $object->withBookingTerms(BookingTermsFactory::fromJson($json->booking_terms));
        }
        if (property_exists($json, 'booking_requests')) {
            $items = [];
            foreach ($json->booking_requests ?? [] as $item) {
                $items[] = BookingRequestStatusFactory::fromJson($item);
            }
            $object->withBookingRequests($items);
        }
        if (property_exists($json, 'last_updated')) {
            $object->withLastUpdated($json->last_updated === null ? null : new DateTime($json->last_updated));
        }

        return $object;
    }
}
