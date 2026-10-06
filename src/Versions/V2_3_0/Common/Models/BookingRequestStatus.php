<?php

declare(strict_types=1);

namespace Chargemap\OCPI\Versions\V2_3_0\Common\Models;

use Chargemap\OCPI\Common\Utils\DateTimeFormatter;
use DateTime;
use JsonSerializable;

class BookingRequestStatus implements JsonSerializable
{
    private ReservationRequestStatus $requestStatus;

    private BookingRequest $bookingRequest;

    private DateTime $requestReceived;

    public function __construct(
        ReservationRequestStatus $requestStatus,
        BookingRequest $bookingRequest,
        DateTime $requestReceived
    )
    {
        $this->requestStatus = $requestStatus;
        $this->bookingRequest = $bookingRequest;
        $this->requestReceived = $requestReceived;
    }

    public function getRequestStatus(): ReservationRequestStatus
    {
        return $this->requestStatus;
    }

    public function getBookingRequest(): BookingRequest
    {
        return $this->bookingRequest;
    }

    public function getRequestReceived(): DateTime
    {
        return $this->requestReceived;
    }

    public function jsonSerialize(): array
    {
        $return = [
            'request_status' => $this->requestStatus,
            'booking_request' => $this->bookingRequest,
            'request_received' => DateTimeFormatter::format($this->requestReceived),
        ];


        return $return;
    }
}
