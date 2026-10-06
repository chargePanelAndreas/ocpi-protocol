<?php

declare(strict_types=1);

namespace Chargemap\OCPI\Versions\V2_3_0\Server\Receiver\Bookings;

use Chargemap\OCPI\Versions\V2_3_0\Common\Factories\BookingFactory;
use Chargemap\OCPI\Versions\V2_3_0\Common\Models\Booking;
use Chargemap\OCPI\Versions\V2_3_0\Server\Generic\BodyRequest;
use Psr\Http\Message\ServerRequestInterface;

class ReceiverBookingPutRequest extends BodyRequest
{
    public function __construct(ServerRequestInterface $request, string $countryCode, string $partyId, string $bookingId)
    {
        parent::__construct($request, 'V2_3_0/Receiver/Bookings/bookingPutRequest.schema.json', static fn($json) => BookingFactory::fromJson($json), ['countryCode' => $countryCode, 'partyId' => $partyId, 'bookingId' => $bookingId]);
    }

    public function getBooking(): Booking
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

    public function getBookingId(): string
    {
        return $this->getParam('bookingId');
    }
}
