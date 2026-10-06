<?php

declare(strict_types=1);

namespace Chargemap\OCPI\Versions\V2_3_0\Common\Factories;

use Chargemap\OCPI\Versions\V2_3_0\Common\Models\BookingRequestStatus;
use Chargemap\OCPI\Versions\V2_3_0\Common\Models\ReservationRequestStatus;
use DateTime;
use stdClass;

class BookingRequestStatusFactory
{
    /**
     * @param stdClass[]|null $json
     * @return BookingRequestStatus[]|null
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

    public static function fromJson(?stdClass $json): ?BookingRequestStatus
    {
        if ($json === null) {
            return null;
        }

        $object = new BookingRequestStatus(
            new ReservationRequestStatus($json->request_status),
            BookingRequestFactory::fromJson($json->booking_request),
            new DateTime($json->request_received)
        );

        return $object;
    }
}
