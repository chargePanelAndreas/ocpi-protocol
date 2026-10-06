<?php

declare(strict_types=1);

namespace Chargemap\OCPI\Versions\V2_3_0\Client\Sender;

use Chargemap\OCPI\Common\Client\Modules\AbstractFeatures;
use Chargemap\OCPI\Versions\V2_3_0\Client\Generic\JsonRequest;
use Chargemap\OCPI\Versions\V2_3_0\Client\Generic\JsonResponse;
use Chargemap\OCPI\Versions\V2_3_0\Client\Generic\JsonService;
use Chargemap\OCPI\Versions\V2_3_0\Common\Factories\BookingFactory;
use Chargemap\OCPI\Versions\V2_3_0\Common\Factories\BookingLocationFactory;
use Chargemap\OCPI\Versions\V2_3_0\Common\Factories\CalendarFactory;
use Chargemap\OCPI\Versions\V2_3_0\Common\Models\BookingRequest;
use Chargemap\OCPI\Versions\V2_3_0\Common\Models\ModuleId;

class Bookings extends AbstractFeatures
{
    /**
     * @throws \Chargemap\OCPI\Common\Client\OcpiEndpointNotFoundException
     * @throws \Chargemap\OCPI\Common\Server\Errors\OcpiInvalidPayloadClientError
     * @throws \Chargemap\OCPI\Common\Client\OcpiUnauthorizedException
     * @throws \Psr\Http\Client\ClientExceptionInterface
     */
    public function getBookingLocations(?JsonRequest $request = null): JsonResponse
    {
        $request = $request ?? new JsonRequest(ModuleId::BOOKINGS(), 'GET', '/booking_locations', null, []);
        return (new JsonService($this->ocpiConfiguration))->listing($request, 'V2_3_0/Sender/Bookings/bookingLocationGetListingResponse.schema.json', null, static fn($data) => BookingLocationFactory::fromJson($data));
    }

    /**
     * @throws \Chargemap\OCPI\Common\Client\OcpiEndpointNotFoundException
     * @throws \Chargemap\OCPI\Common\Server\Errors\OcpiInvalidPayloadClientError
     * @throws \Psr\Http\Client\ClientExceptionInterface
     */
    public function getBookingLocation(string $bookingLocationId): JsonResponse
    {
        $request = new JsonRequest(ModuleId::BOOKINGS(), 'GET', '/booking_locations/' . $bookingLocationId, null, []);
        return (new JsonService($this->ocpiConfiguration))->object($request, 'V2_3_0/Sender/Bookings/bookingLocationGetResponse.schema.json', static fn($data) => BookingLocationFactory::fromJson($data));
    }

    /**
     * @throws \Chargemap\OCPI\Common\Client\OcpiEndpointNotFoundException
     * @throws \Chargemap\OCPI\Common\Server\Errors\OcpiInvalidPayloadClientError
     * @throws \Psr\Http\Client\ClientExceptionInterface
     */
    public function getCalendar(string $bookingLocationId, string $calendarId): JsonResponse
    {
        $request = new JsonRequest(ModuleId::BOOKINGS(), 'GET', '/booking_locations/' . $bookingLocationId . '/' . $calendarId, null, []);
        return (new JsonService($this->ocpiConfiguration))->object($request, 'V2_3_0/Sender/Bookings/calendarGetResponse.schema.json', static fn($data) => CalendarFactory::fromJson($data));
    }

    /**
     * @throws \Chargemap\OCPI\Common\Client\OcpiEndpointNotFoundException
     * @throws \Chargemap\OCPI\Common\Server\Errors\OcpiInvalidPayloadClientError
     * @throws \Chargemap\OCPI\Common\Client\OcpiUnauthorizedException
     * @throws \Psr\Http\Client\ClientExceptionInterface
     */
    public function getBookings(?JsonRequest $request = null): JsonResponse
    {
        $request = $request ?? new JsonRequest(ModuleId::BOOKINGS(), 'GET', '', null, []);
        return (new JsonService($this->ocpiConfiguration))->listing($request, 'V2_3_0/Sender/Bookings/bookingGetListingResponse.schema.json', null, static fn($data) => BookingFactory::fromJson($data));
    }

    /**
     * @throws \Chargemap\OCPI\Common\Client\OcpiEndpointNotFoundException
     * @throws \Chargemap\OCPI\Common\Server\Errors\OcpiInvalidPayloadClientError
     * @throws \Psr\Http\Client\ClientExceptionInterface
     */
    public function postBooking(BookingRequest $body): JsonResponse
    {
        $request = new JsonRequest(ModuleId::BOOKINGS(), 'POST', '', $body, []);
        return (new JsonService($this->ocpiConfiguration))->object($request, 'V2_3_0/Sender/Bookings/bookingPostResponse.schema.json', static fn($data) => BookingFactory::fromJson($data));
    }
}
