<?php

declare(strict_types=1);

namespace Chargemap\OCPI\Versions\V2_3_0\Common\Factories;

use Chargemap\OCPI\Versions\V2_3_0\Common\Models\BookingRequest;
use stdClass;

class BookingRequestFactory
{
    /**
     * @param stdClass[]|null $json
     * @return BookingRequest[]|null
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

    public static function fromJson(?stdClass $json): ?BookingRequest
    {
        if ($json === null) {
            return null;
        }

        $object = new BookingRequest(
            $json->country_code,
            $json->party_id,
            $json->request_id,
            $json->location_id,
            $json->booking_location_id,
            PeriodFactory::fromJson($json->period),
            $json->authorization_reference,
            BookingOptionFactory::fromJson($json->booking_option ?? null),
            $json->power_required ?? null,
            CancellationFactory::fromJson($json->canceled ?? null)
        );

        foreach ($json->tokens ?? [] as $item) {
            $object->addToken(BookingTokenFactory::fromJson($item));
        }

        foreach ($json->access_information ?? [] as $item) {
            $object->addAccessInformation(AccessInformationFactory::fromJson($item));
        }

        return $object;
    }
}
