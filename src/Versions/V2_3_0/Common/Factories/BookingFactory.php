<?php

declare(strict_types=1);

namespace Chargemap\OCPI\Versions\V2_3_0\Common\Factories;

use Chargemap\OCPI\Versions\V2_3_0\Common\Models\Booking;
use Chargemap\OCPI\Versions\V2_3_0\Common\Models\ReservationStatus;
use DateTime;
use stdClass;

class BookingFactory
{
    /**
     * @param stdClass[]|null $json
     * @return Booking[]|null
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

    public static function fromJson(?stdClass $json): ?Booking
    {
        if ($json === null) {
            return null;
        }

        $bookingRequests = [];
        foreach ($json->booking_requests as $item) {
            $bookingRequests[] = BookingRequestStatusFactory::fromJson($item);
        }

        $object = new Booking(
            $json->id,
            $json->country_code,
            $json->party_id,
            $json->request_id,
            $json->location_id,
            TimeslotFactory::fromJson($json->period),
            new ReservationStatus($json->reservation_status),
            $json->authorization_reference,
            BookingTermsFactory::fromJson($json->booking_terms),
            $bookingRequests,
            new DateTime($json->last_updated),
            BookingOptionFactory::fromJson($json->booking_option ?? null),
            CancellationFactory::fromJson($json->canceled ?? null)
        );

        foreach ($json->booking_tokens ?? [] as $item) {
            $object->addBookingToken(BookingTokenFactory::fromJson($item));
        }

        foreach ($json->tariff_ids ?? [] as $item) {
            $object->addTariffId($item);
        }

        foreach ($json->access_information ?? [] as $item) {
            $object->addAccessInformation(AccessInformationFactory::fromJson($item));
        }

        return $object;
    }
}
