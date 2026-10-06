<?php

declare(strict_types=1);

namespace Chargemap\OCPI\Versions\V2_3_0\Server\Sender\Bookings;

use Chargemap\OCPI\Versions\V2_3_0\Common\Factories\BookingRequestFactory;
use Chargemap\OCPI\Versions\V2_3_0\Common\Models\BookingRequest;
use Chargemap\OCPI\Versions\V2_3_0\Server\Generic\BodyRequest;
use Psr\Http\Message\ServerRequestInterface;

class SenderBookingPostRequest extends BodyRequest
{
    public function __construct(ServerRequestInterface $request)
    {
        parent::__construct($request, 'V2_3_0/Sender/Bookings/bookingPostRequest.schema.json', static fn($json) => BookingRequestFactory::fromJson($json), []);
    }

    public function getBookingRequest(): BookingRequest
    {
        return $this->model();
    }
}
