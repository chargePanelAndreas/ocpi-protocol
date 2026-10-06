<?php

declare(strict_types=1);

namespace Chargemap\OCPI\Versions\V2_3_0\Client\Receiver;

use Chargemap\OCPI\Common\Client\Modules\AbstractFeatures;
use Chargemap\OCPI\Versions\V2_3_0\Client\Generic\JsonRequest;
use Chargemap\OCPI\Versions\V2_3_0\Client\Generic\JsonResponse;
use Chargemap\OCPI\Versions\V2_3_0\Client\Generic\JsonService;
use Chargemap\OCPI\Versions\V2_3_0\Common\Factories\BookingFactory;
use Chargemap\OCPI\Versions\V2_3_0\Common\Factories\BookingLocationFactory;
use Chargemap\OCPI\Versions\V2_3_0\Common\Factories\CalendarFactory;
use Chargemap\OCPI\Versions\V2_3_0\Common\Models\Booking;
use Chargemap\OCPI\Versions\V2_3_0\Common\Models\BookingLocation;
use Chargemap\OCPI\Versions\V2_3_0\Common\Models\Calendar;
use Chargemap\OCPI\Versions\V2_3_0\Common\Models\ModuleId;
use Chargemap\OCPI\Versions\V2_3_0\Common\Models\PartialBooking;
use Chargemap\OCPI\Versions\V2_3_0\Common\Models\PartialBookingLocation;
use Chargemap\OCPI\Versions\V2_3_0\Common\Models\PartialCalendar;

class Bookings extends AbstractFeatures
{
    /**
     * @throws \Chargemap\OCPI\Common\Client\OcpiEndpointNotFoundException
     * @throws \Chargemap\OCPI\Common\Server\Errors\OcpiInvalidPayloadClientError
     * @throws \Psr\Http\Client\ClientExceptionInterface
     */
    public function getBookingLocation(string $countryCode, string $partyId, string $bookingLocationId): JsonResponse
    {
        $request = new JsonRequest(ModuleId::BOOKINGS(), 'GET', '/' . $countryCode . '/' . $partyId . '/booking_locations/' . $bookingLocationId, null, []);
        return (new JsonService($this->ocpiConfiguration))->object($request, 'V2_3_0/Receiver/Bookings/bookingLocationGetResponse.schema.json', static fn($data) => BookingLocationFactory::fromJson($data));
    }

    /**
     * @throws \Chargemap\OCPI\Common\Client\OcpiEndpointNotFoundException
     * @throws \Chargemap\OCPI\Common\Server\Errors\OcpiInvalidPayloadClientError
     * @throws \Psr\Http\Client\ClientExceptionInterface
     */
    public function putBookingLocation(string $countryCode, string $partyId, string $bookingLocationId, BookingLocation $body): JsonResponse
    {
        $request = new JsonRequest(ModuleId::BOOKINGS(), 'PUT', '/' . $countryCode . '/' . $partyId . '/booking_locations/' . $bookingLocationId, $body, []);
        return (new JsonService($this->ocpiConfiguration))->status($request);
    }

    /**
     * @throws \Chargemap\OCPI\Common\Client\OcpiEndpointNotFoundException
     * @throws \Chargemap\OCPI\Common\Server\Errors\OcpiInvalidPayloadClientError
     * @throws \Psr\Http\Client\ClientExceptionInterface
     */
    public function patchBookingLocation(string $countryCode, string $partyId, string $bookingLocationId, PartialBookingLocation $body): JsonResponse
    {
        $request = new JsonRequest(ModuleId::BOOKINGS(), 'PATCH', '/' . $countryCode . '/' . $partyId . '/booking_locations/' . $bookingLocationId, $body, []);
        return (new JsonService($this->ocpiConfiguration))->status($request);
    }

    /**
     * @throws \Chargemap\OCPI\Common\Client\OcpiEndpointNotFoundException
     * @throws \Chargemap\OCPI\Common\Server\Errors\OcpiInvalidPayloadClientError
     * @throws \Psr\Http\Client\ClientExceptionInterface
     */
    public function getCalendar(string $countryCode, string $partyId, string $bookingLocationId, string $calendarId): JsonResponse
    {
        $request = new JsonRequest(ModuleId::BOOKINGS(), 'GET', '/' . $countryCode . '/' . $partyId . '/booking_locations/' . $bookingLocationId . '/' . $calendarId, null, []);
        return (new JsonService($this->ocpiConfiguration))->object($request, 'V2_3_0/Receiver/Bookings/calendarGetResponse.schema.json', static fn($data) => CalendarFactory::fromJson($data));
    }

    /**
     * @throws \Chargemap\OCPI\Common\Client\OcpiEndpointNotFoundException
     * @throws \Chargemap\OCPI\Common\Server\Errors\OcpiInvalidPayloadClientError
     * @throws \Psr\Http\Client\ClientExceptionInterface
     */
    public function putCalendar(string $countryCode, string $partyId, string $bookingLocationId, string $calendarId, Calendar $body): JsonResponse
    {
        $request = new JsonRequest(ModuleId::BOOKINGS(), 'PUT', '/' . $countryCode . '/' . $partyId . '/booking_locations/' . $bookingLocationId . '/' . $calendarId, $body, []);
        return (new JsonService($this->ocpiConfiguration))->status($request);
    }

    /**
     * @throws \Chargemap\OCPI\Common\Client\OcpiEndpointNotFoundException
     * @throws \Chargemap\OCPI\Common\Server\Errors\OcpiInvalidPayloadClientError
     * @throws \Psr\Http\Client\ClientExceptionInterface
     */
    public function patchCalendar(string $countryCode, string $partyId, string $bookingLocationId, string $calendarId, PartialCalendar $body): JsonResponse
    {
        $request = new JsonRequest(ModuleId::BOOKINGS(), 'PATCH', '/' . $countryCode . '/' . $partyId . '/booking_locations/' . $bookingLocationId . '/' . $calendarId, $body, []);
        return (new JsonService($this->ocpiConfiguration))->status($request);
    }

    /**
     * @throws \Chargemap\OCPI\Common\Client\OcpiEndpointNotFoundException
     * @throws \Chargemap\OCPI\Common\Server\Errors\OcpiInvalidPayloadClientError
     * @throws \Psr\Http\Client\ClientExceptionInterface
     */
    public function getBooking(string $countryCode, string $partyId, string $bookingId): JsonResponse
    {
        $request = new JsonRequest(ModuleId::BOOKINGS(), 'GET', '/' . $countryCode . '/' . $partyId . '/' . $bookingId, null, []);
        return (new JsonService($this->ocpiConfiguration))->object($request, 'V2_3_0/Receiver/Bookings/bookingGetResponse.schema.json', static fn($data) => BookingFactory::fromJson($data));
    }

    /**
     * @throws \Chargemap\OCPI\Common\Client\OcpiEndpointNotFoundException
     * @throws \Chargemap\OCPI\Common\Server\Errors\OcpiInvalidPayloadClientError
     * @throws \Psr\Http\Client\ClientExceptionInterface
     */
    public function putBooking(string $countryCode, string $partyId, string $bookingId, Booking $body): JsonResponse
    {
        $request = new JsonRequest(ModuleId::BOOKINGS(), 'PUT', '/' . $countryCode . '/' . $partyId . '/' . $bookingId, $body, []);
        return (new JsonService($this->ocpiConfiguration))->status($request);
    }

    /**
     * @throws \Chargemap\OCPI\Common\Client\OcpiEndpointNotFoundException
     * @throws \Chargemap\OCPI\Common\Server\Errors\OcpiInvalidPayloadClientError
     * @throws \Psr\Http\Client\ClientExceptionInterface
     */
    public function patchBooking(string $countryCode, string $partyId, string $bookingId, PartialBooking $body): JsonResponse
    {
        $request = new JsonRequest(ModuleId::BOOKINGS(), 'PATCH', '/' . $countryCode . '/' . $partyId . '/' . $bookingId, $body, []);
        return (new JsonService($this->ocpiConfiguration))->status($request);
    }
}
