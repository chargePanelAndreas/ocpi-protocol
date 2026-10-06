<?php

declare(strict_types=1);

namespace Chargemap\OCPI\Versions\V2_3_0\Server\Sender\Bookings;

use Chargemap\OCPI\Versions\V2_3_0\Server\Generic\ParamsRequest;
use Psr\Http\Message\ServerRequestInterface;

class SenderBookingLocationGetRequest extends ParamsRequest
{
    public function __construct(ServerRequestInterface $request, string $bookingLocationId)
    {
        parent::__construct($request, ['bookingLocationId' => $bookingLocationId]);
    }

    public function getBookingLocationId(): string
    {
        return $this->getParam('bookingLocationId');
    }
}
