<?php

declare(strict_types=1);

namespace Tests\Chargemap\OCPI\Versions\V2_1_1\Server\Cpo\Locations\Evses\Connectors\Get;

use Chargemap\OCPI\Common\Server\StatusCodes\OcpiSuccessHttpCode;
use Chargemap\OCPI\Versions\V2_1_1\Common\Factories\ConnectorFactory;
use Chargemap\OCPI\Versions\V2_1_1\Server\Cpo\Locations\Evses\Connectors\Get\OcpiCpoConnectorGetResponse;
use PHPUnit\Framework\TestCase;
use Tests\Chargemap\OCPI\OcpiTestCase;
use Tests\Chargemap\OCPI\Versions\V2_1_1\Common\Models\ConnectorTest;

/**
 * @covers \Chargemap\OCPI\Versions\V2_1_1\Server\Emsp\Locations\Sender\Connectors\Get\OcpiCpoConnectorGetResponse
 */
class ResponseConstructionTest extends TestCase
{
    public function validPayloadsProvider(): iterable
    {
        foreach (scandir(__DIR__ . '/payloads/valid/') as $filename) {
            if( $filename !== '.' && $filename !== '..') {
                yield basename($filename, '.json') => [
                    'payload' => file_get_contents( __DIR__ . '/payloads/valid/' . $filename ),
                ];
            }
        }
    }

    /**
     * @dataProvider validPayloadsProvider
     * @param string $payload
     */
    public function testShouldSerializeConnectorCorrectlyWithFullPayload(string $payload)
    {
        $connector = ConnectorFactory::fromJson(json_decode($payload));
        $response = new OcpiCpoConnectorGetResponse($connector);

        $responseInterface = $response->getResponseInterface();
        $this->assertSame(OcpiSuccessHttpCode::HTTP_OK, $responseInterface->getStatusCode());
        $json = json_decode($responseInterface->getBody()->getContents());
        OcpiTestCase::coerce('V2_1_1/CPO/Locations/Evses/Connectors/connectorGetResponse.schema.json', $json);
        ConnectorTest::assertJsonSerialization($connector, $json->data);
    }
}
