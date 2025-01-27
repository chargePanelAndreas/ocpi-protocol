<?php

declare(strict_types=1);

namespace Tests\Chargemap\OCPI\Versions\V2_2_1\Server\Sender\Tariffs\GetListing;

use Chargemap\OCPI\Versions\V2_2_1\Common\Factories\TariffFactory;
use Chargemap\OCPI\Versions\V2_2_1\Server\Sender\Tariffs\GetListing\SenderTariffGetListingRequest;
use Chargemap\OCPI\Versions\V2_2_1\Server\Sender\Tariffs\GetListing\SenderTariffGetListingResponse;
use Http\Discovery\Psr17FactoryDiscovery;
use PHPUnit\Framework\TestCase;
use Tests\Chargemap\OCPI\OcpiTestCase;
use Tests\Chargemap\OCPI\Versions\V2_2_1\Common\Models\TariffTest;

/**
 * @covers \Chargemap\OCPI\Versions\V2_2_1\Server\Sender\Tariffs\GetListing\SenderTariffGetListingResponse
 */
class ResponseConstructionTest extends TestCase
{
    public function testShouldReturnEmptyArrayWithoutTokens(): void
    {
        $response = new SenderTariffGetListingResponse(self::getRequest(), 0, 10);
        $responseInterface = $response->getResponseInterface();
        $this->assertSame([], json_decode($responseInterface->getBody()->getContents(), true)['data']);
    }

    /**
     * @throws \Exception
     */
    private function getRequest(): SenderTariffGetListingRequest
    {
        return new SenderTariffGetListingRequest(
            Psr17FactoryDiscovery::findServerRequestFactory()->createServerRequest('GET', '/test?offset=10&limit=10')
                ->withQueryParams(['offset' => '10', 'limit' => '10'])
                ->withHeader('Authorization', 'Token 01234567-0123-0123-0123-0123456789ab')
        );
    }

    public function validPayloadsProvider(): iterable
    {
        foreach (scandir(__DIR__ . '/payloads/valid/') as $filename) {
            if ($filename !== '.' && $filename !== '..') {
                yield basename($filename, '.json') => [
                    'payload' => file_get_contents(__DIR__ . '/payloads/valid/' . $filename),
                ];
            }
        }
    }

    /**
     * @dataProvider validPayloadsProvider
     * @param string $payload
     */
    public function testShouldReturnDataWithTariffs(string $payload): void
    {
        $response = new SenderTariffGetListingResponse(self::getRequest(), 0, 10);
        $locations = [];
        foreach (json_decode($payload)->data as $index => $jsonTariff) {
            $location = TariffFactory::fromJson($jsonTariff);
            $locations[$index] = $location;
            $response->addTariff($location);
        }
        $responseInterface = $response->getResponseInterface();
        $payload = json_decode($responseInterface->getBody()->getContents());
        OcpiTestCase::coerce('V2_2_1/Sender/Tariffs/tariffGetListingResponse.schema.json', $payload);
        foreach ($payload->data as $index => $jsonTariff) {
            TariffTest::assertJsonSerialization($locations[$index], $jsonTariff);
        }
    }
}
