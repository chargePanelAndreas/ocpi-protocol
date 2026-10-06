<?php

declare(strict_types=1);

namespace Chargemap\OCPI\Versions\V2_3_0\Server\Receiver\Bookings;

use Chargemap\OCPI\Versions\V2_3_0\Server\Generic\ParamsRequest;
use Psr\Http\Message\ServerRequestInterface;

class ReceiverBookingGetRequest extends ParamsRequest
{
    public function __construct(ServerRequestInterface $request, string $countryCode, string $partyId, string $bookingId)
    {
        parent::__construct($request, ['countryCode' => $countryCode, 'partyId' => $partyId, 'bookingId' => $bookingId]);
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
