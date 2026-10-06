<?php

declare(strict_types=1);

namespace Chargemap\OCPI\Versions\V2_3_0\Server\Receiver\Bookings;

use Chargemap\OCPI\Versions\V2_3_0\Common\Factories\PartialCalendarFactory;
use Chargemap\OCPI\Versions\V2_3_0\Common\Models\PartialCalendar;
use Chargemap\OCPI\Versions\V2_3_0\Server\Generic\BodyRequest;
use Psr\Http\Message\ServerRequestInterface;

class ReceiverCalendarPatchRequest extends BodyRequest
{
    public function __construct(ServerRequestInterface $request, string $countryCode, string $partyId, string $bookingLocationId, string $calendarId)
    {
        parent::__construct($request, 'V2_3_0/Receiver/Bookings/calendarPatchRequest.schema.json', static fn($json) => PartialCalendarFactory::fromJson($json), ['countryCode' => $countryCode, 'partyId' => $partyId, 'bookingLocationId' => $bookingLocationId, 'calendarId' => $calendarId]);
    }

    public function getCalendar(): PartialCalendar
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

    public function getCalendarId(): string
    {
        return $this->getParam('calendarId');
    }
}
