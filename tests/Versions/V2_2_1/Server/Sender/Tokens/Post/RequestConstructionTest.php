<?php

declare(strict_types=1);

namespace Tests\Chargemap\OCPI\Versions\V2_2_1\Server\Sender\Tokens\Post;

use Chargemap\OCPI\Common\Server\Errors\OcpiInvalidPayloadClientError;
use Chargemap\OCPI\Versions\V2_2_1\Common\Models\TokenType;
use Chargemap\OCPI\Versions\V2_2_1\Server\Sender\Tokens\Post\SenderTokenPostRequest;
use Http\Discovery\Psr17FactoryDiscovery;
use Tests\Chargemap\OCPI\OcpiTestCase;
use Tests\Chargemap\OCPI\Versions\V2_2_1\Common\Factories\LocationReferencesFactoryTest;

/**
 * @covers \Chargemap\OCPI\Versions\V2_2_1\Server\Sender\Tokens\Post\OcpiEmspTokenPostRequest
 */
class RequestConstructionTest extends OcpiTestCase
{
    public function validParametersProvider(): iterable
    {
        foreach (scandir(__DIR__ . '/payloads/valid/') as $filename) {
            if (!is_dir(__DIR__ . '/payloads/valid/'. $filename)) {
                yield basename($filename, '.json') => [
                    'payload' => file_get_contents( __DIR__ . '/payloads/valid/' . $filename ),
                ];
            }
        }
    }

    public function invalidParametersProvider(): iterable
    {
        foreach (scandir(__DIR__ . '/payloads/invalid/') as $filename) {
            if (!is_dir(__DIR__ . '/payloads/invalid/'. $filename)) {
                yield basename($filename, '.json') => [
                    'payload' => file_get_contents(__DIR__ . '/payloads/invalid/' . $filename),
                ];
            }
        }
    }

    /**
     * @param string $payload
     * @dataProvider validParametersProvider()
     */
    public function testShouldConstructRequestWithPayload(string $payload): void
    {
        $json = null;

        $serverRequestInterface = Psr17FactoryDiscovery::findServerRequestFactory()
            ->createServerRequest('GET', 'randomUrl')
            ->withQueryParams(['type' => 'rfid'])
            ->withHeader('Authorization', 'Token IpbJOXxkxOAuKR92z0nEcmVF3Qw09VG7I7d/WCg0koM=');

        if (!empty($payload)) {
            $json = json_decode($payload);
            $serverRequestInterface = $serverRequestInterface->withBody(Psr17FactoryDiscovery::findStreamFactory()->createStream($payload));
        }

        $request = new SenderTokenPostRequest($serverRequestInterface, '4050933D');

        $this->assertEquals('4050933D', $request->getTokenId());
        $this->assertEquals(TokenType::RFID, $request->getTokenType()->getValue());

        LocationReferencesFactoryTest::assertLocationReferences($json, $request->getLocationReferences());
    }

    /**
     * @param string $payload
     * @dataProvider validParametersProvider()
     */
    public function testShouldConstructRequestWithOtherAuthenticationType(string $payload): void
    {
        $json = null;

        $serverRequestInterface = Psr17FactoryDiscovery::findServerRequestFactory()
            ->createServerRequest('GET', 'randomUrl')
            ->withQueryParams(['type' => 'other'])
            ->withHeader('Authorization', 'Token IpbJOXxkxOAuKR92z0nEcmVF3Qw09VG7I7d/WCg0koM=');

        if (!empty($payload)) {
            $json = json_decode($payload);
            $serverRequestInterface = $serverRequestInterface->withBody(Psr17FactoryDiscovery::findStreamFactory()->createStream($payload));
        }

        $request = new SenderTokenPostRequest($serverRequestInterface, '12345');

        $this->assertEquals('12345', $request->getTokenId());
        $this->assertEquals(TokenType::OTHER, $request->getTokenType()->getValue());

        LocationReferencesFactoryTest::assertLocationReferences($json, $request->getLocationReferences());
    }

    /**
     * @param string $payload
     * @dataProvider validParametersProvider()
     */
    public function testShouldConstructRequestWithoutAuthenticationType(string $payload): void
    {
        $json = null;

        $serverRequestInterface = Psr17FactoryDiscovery::findServerRequestFactory()
            ->createServerRequest('GET', 'randomUrl')
            ->withHeader('Authorization', 'Token IpbJOXxkxOAuKR92z0nEcmVF3Qw09VG7I7d/WCg0koM=');

        if (!empty($payload)) {
            $json = json_decode($payload);
            $serverRequestInterface = $serverRequestInterface->withBody(Psr17FactoryDiscovery::findStreamFactory()->createStream($payload));
        }

        $request = new SenderTokenPostRequest($serverRequestInterface, '12345');

        $this->assertEquals('12345', $request->getTokenId());
        $this->assertEquals(TokenType::RFID, $request->getTokenType()->getValue());

        LocationReferencesFactoryTest::assertLocationReferences($json, $request->getLocationReferences());
    }

    /**
     * @param string $payload
     * @dataProvider invalidParametersProvider()
     */
    public function testShouldFailWithInvalidArgument(string $payload): void
    {
        $this->expectException(OcpiInvalidPayloadClientError::class);

        $json = null;

        $serverRequestInterface = Psr17FactoryDiscovery::findServerRequestFactory()
            ->createServerRequest('GET', 'randomUrl')
            ->withQueryParams(['type' => 'rfid'])
            ->withHeader('Authorization', 'Token IpbJOXxkxOAuKR92z0nEcmVF3Qw09VG7I7d/WCg0koM=');

        if (!empty($payload)) {
            $serverRequestInterface = $serverRequestInterface->withBody(Psr17FactoryDiscovery::findStreamFactory()->createStream($payload));
        }

        new SenderTokenPostRequest($serverRequestInterface, '4050933D');
    }
}
