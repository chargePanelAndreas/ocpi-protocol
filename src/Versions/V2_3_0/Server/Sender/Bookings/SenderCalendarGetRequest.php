<?php

declare(strict_types=1);

namespace Chargemap\OCPI\Versions\V2_3_0\Server\Sender\Bookings;

use Chargemap\OCPI\Versions\V2_3_0\Server\Generic\ParamsRequest;
use Psr\Http\Message\ServerRequestInterface;

class SenderCalendarGetRequest extends ParamsRequest
{
    public function __construct(ServerRequestInterface $request, string $bookingLocationId, string $calendarId)
    {
        parent::__construct($request, ['bookingLocationId' => $bookingLocationId, 'calendarId' => $calendarId]);
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
