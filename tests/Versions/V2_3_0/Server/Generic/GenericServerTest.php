<?php

declare(strict_types=1);

namespace Tests\Chargemap\OCPI\Versions\V2_3_0\Server\Generic;

use Chargemap\OCPI\Common\Server\Errors\OcpiGenericClientError;
use Chargemap\OCPI\Common\Server\Errors\OcpiNotEnoughInformationClientError;
use Chargemap\OCPI\Versions\V2_3_0\Common\Factories\ClientInfoFactory;
use Chargemap\OCPI\Versions\V2_3_0\Common\Models\Booking;
use Chargemap\OCPI\Versions\V2_3_0\Common\Models\Terminal;
use Chargemap\OCPI\Versions\V2_3_0\Server\Generic\ListingResponse;
use Chargemap\OCPI\Versions\V2_3_0\Server\Generic\ObjectResponse;
use Chargemap\OCPI\Versions\V2_3_0\Server\Receiver\Bookings\ReceiverBookingGetRequest;
use Chargemap\OCPI\Versions\V2_3_0\Server\Receiver\Bookings\ReceiverBookingPutRequest;
use Chargemap\OCPI\Versions\V2_3_0\Server\Receiver\ChargingProfiles\ReceiverActiveChargingProfileGetRequest;
use Chargemap\OCPI\Versions\V2_3_0\Server\Sender\ChargingProfiles\SenderChargingProfileResultPostRequest;
use Chargemap\OCPI\Versions\V2_3_0\Server\Sender\HubClientInfo\SenderClientInfoGetListingRequest;
use Chargemap\OCPI\Versions\V2_3_0\Server\Sender\Payments\SenderTerminalPutRequest;
use Http\Discovery\Psr17FactoryDiscovery;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ServerRequestInterface;
use Tests\Chargemap\OCPI\InvalidPayloadException;

/**
 * @covers \Chargemap\OCPI\Versions\V2_3_0\Server\Generic\BodyRequest
 * @covers \Chargemap\OCPI\Versions\V2_3_0\Server\Generic\ParamsRequest
 * @covers \Chargemap\OCPI\Versions\V2_3_0\Server\Generic\ObjectResponse
 * @covers \Chargemap\OCPI\Versions\V2_3_0\Server\Generic\ListingResponse
 */
class GenericServerTest extends TestCase
{
    private const FIXTURES = __DIR__ . '/../../Common/Factories/Payloads/';

    private function request(string $method, string $uri, ?string $body = null, bool $auth = true): ServerRequestInterface
    {
        $request = Psr17FactoryDiscovery::findServerRequestFactory()->createServerRequest($method, $uri);
        if ($auth) {
            $request = $request->withHeader('Authorization', 'Token abc');
        }
        if ($body !== null) {
            $request = $request->withBody(Psr17FactoryDiscovery::findStreamFactory()->createStream($body));
        }
        parse_str(parse_url($uri, PHP_URL_QUERY) ?? '', $query);
        return $request->withQueryParams($query);
    }

    private function fixture(string $name): string
    {
        return file_get_contents(self::FIXTURES . $name . '/sample1.json');
    }

    public function testBodyRequestWithModel(): void
    {
        $request = new ReceiverBookingPutRequest($this->request('PUT', '/', $this->fixture('Booking')), 'FR', 'ABC', 'booking-1');

        self::assertInstanceOf(Booking::class, $request->getBooking());
        self::assertSame('FR', $request->getCountryCode());
        self::assertSame('ABC', $request->getPartyId());
        self::assertSame('booking-1', $request->getBookingId());
        self::assertSame('abc', $request->getAuthorization());
    }

    public function testBodyRequestWithoutParams(): void
    {
        $request = new SenderTerminalPutRequest($this->request('PUT', '/', $this->fixture('Terminal')), 't1');

        self::assertInstanceOf(Terminal::class, $request->getTerminal());
        self::assertSame('t1', $request->getTerminalId());
    }

    public function testBodyRequestWithRawResult(): void
    {
        $request = new SenderChargingProfileResultPostRequest(
            $this->request('POST', '/', $this->fixture('ActiveChargingProfileResult'))
        );

        self::assertSame('ACCEPTED', $request->getResult()->result);
    }

    public function testEmptyBodyIsRejected(): void
    {
        $this->expectException(OcpiNotEnoughInformationClientError::class);
        new ReceiverBookingPutRequest($this->request('PUT', '/', ''), 'FR', 'ABC', 'b');
    }

    public function testInvalidPayloadIsRejected(): void
    {
        $this->expectException(\Chargemap\OCPI\Common\Server\Errors\OcpiInvalidPayloadClientError::class);
        new ReceiverBookingPutRequest($this->request('PUT', '/', '{"foo":"bar"}'), 'FR', 'ABC', 'b');
    }

    public function testInvalidParamsAreRejected(): void
    {
        $this->expectException(OcpiGenericClientError::class);
        new ReceiverBookingGetRequest($this->request('GET', '/'), 'FRA', 'ABC', 'b');
    }

    public function testMissingAuthorizationIsRejected(): void
    {
        $this->expectException(OcpiNotEnoughInformationClientError::class);
        new ReceiverBookingGetRequest($this->request('GET', '/', null, false), 'FR', 'ABC', 'b');
    }

    public function testQueryParameters(): void
    {
        $request = new ReceiverActiveChargingProfileGetRequest(
            $this->request('GET', '/s1?duration=300&response_url=https%3A%2F%2Fexample.com%2Fcb'),
            's1'
        );

        self::assertSame('s1', $request->getSessionId());
        self::assertSame(300, $request->getDuration());
        self::assertSame('https://example.com/cb', $request->getResponseUrl());
    }

    public function testObjectResponse(): void
    {
        $booking = new ObjectResponse(ClientInfoFactory::fromJson(json_decode($this->fixture('ClientInfo'))));
        $response = $booking->getResponseInterface();

        self::assertSame(200, $response->getStatusCode());
        $json = json_decode($response->getBody()->__toString());
        self::assertSame(1000, $json->status_code);
        self::assertEquals(json_decode($this->fixture('ClientInfo')), $json->data);

        self::assertSame(201, ObjectResponse::created()->getResponseInterface()->getStatusCode());
    }

    public function testListingResponse(): void
    {
        $request = new SenderClientInfoGetListingRequest($this->request('GET', '/hubclientinfo?limit=1'));
        $response = (new ListingResponse($request, 2, 1))
            ->addItem(ClientInfoFactory::fromJson(json_decode($this->fixture('ClientInfo'))))
            ->getResponseInterface();

        self::assertSame('2', $response->getHeaderLine('X-Total-Count'));
        self::assertSame('1', $response->getHeaderLine('X-Limit'));
        self::assertStringContainsString('offset=1', $response->getHeaderLine('Link'));
        self::assertCount(1, json_decode($response->getBody()->__toString())->data);
    }
}

