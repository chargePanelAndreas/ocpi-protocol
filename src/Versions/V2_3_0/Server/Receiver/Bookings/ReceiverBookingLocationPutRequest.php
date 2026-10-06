<?php

declare(strict_types=1);

namespace Chargemap\OCPI\Versions\V2_3_0\Server\Receiver\Bookings;

use Chargemap\OCPI\Versions\V2_3_0\Common\Factories\BookingLocationFactory;
use Chargemap\OCPI\Versions\V2_3_0\Common\Models\BookingLocation;
use Chargemap\OCPI\Versions\V2_3_0\Server\Generic\BodyRequest;
use Psr\Http\Message\ServerRequestInterface;

class ReceiverBookingLocationPutRequest extends BodyRequest
{
    public function __construct(ServerRequestInterface $request, string $countryCode, string $partyId, string $bookingLocationId)
    {
        parent::__construct($request, 'V2_3_0/Receiver/Bookings/bookingLocationPutRequest.schema.json', static fn($json) => BookingLocationFactory::fromJson($json), ['countryCode' => $countryCode, 'partyId' => $partyId, 'bookingLocationId' => $bookingLocationId]);
    }

    public function getBookingLocation(): BookingLocation
    {
        return $this->model();
    }

    public function getCountryCode(): string
    {
        return $this->getParam('countryCode');
    }

    public function getPartyId(): string
    {
        return $this->getParam('partyId');
    }

    public function getBookingLocationId(): string
    {
        return $this->getParam('bookingLocationId');
    }
}
