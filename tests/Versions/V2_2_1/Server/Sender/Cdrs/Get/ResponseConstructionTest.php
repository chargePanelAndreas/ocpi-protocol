<?php

declare(strict_types=1);

namespace Tests\Chargemap\OCPI\Versions\V2_2_1\Server\Sender\Cdrs\Get;

use Chargemap\OCPI\Versions\V2_2_1\Common\Factories\CdrFactory;
use Chargemap\OCPI\Versions\V2_2_1\Server\Sender\Cdrs\GetListing\SenderCdrGetListingRequest;
use Chargemap\OCPI\Versions\V2_2_1\Server\Sender\Cdrs\GetListing\SenderCdrGetListingResponse;
use Http\Discovery\Psr17FactoryDiscovery;
use PHPUnit\Framework\TestCase;
use Tests\Chargemap\OCPI\OcpiTestCase;
use Tests\Chargemap\OCPI\Versions\V2_2_1\Common\Models\CdrTest;

/**
 * @covers \Chargemap\OCPI\Versions\V2_2_1\Server\CdrssessionGetResponse.schema.json\SenderCdrGetListingResponse
 */
class ResponseConstructionTest extends TestCase
{
    public function testShouldReturnEmptyArrayWithoutTokens(): void
    {
        $response = new SenderCdrGetListingResponse(self::getRequest(), 0, 10);
        $responseInterface = $response->getResponseInterface();
        $this->assertSame([], json_decode($responseInterface->getBody()->getContents(), true)['data']);
    }

    private function getRequest(): SenderCdrGetListingRequest
    {
        return new SenderCdrGetListingRequest(
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
    public function testShouldReturnDataWithSessions(string $payload): void
    {
        $response = new SenderCdrGetListingResponse(self::getRequest(), 0, 10);
        $cdrs = [];
        foreach (json_decode($payload)->data as $index => $jsonCdr) {
            $cdr = CdrFactory::fromJson($jsonCdr);
            $cdrs[$index] = $cdr;
            $response->addCdr($cdr);
        }
        $responseInterface = $response->getResponseInterface();
        $payload = json_decode($responseInterface->getBody()->getContents());
        OcpiTestCase::coerce('V2_2_1/Sender/CDRs/cdrGetResponse.schema.json', $payload);
        foreach ($payload->data as $index => $jsonCdr) {
            CdrTest::assertJsonSerialization($cdrs[$index], $jsonCdr);
        }
    }
}
