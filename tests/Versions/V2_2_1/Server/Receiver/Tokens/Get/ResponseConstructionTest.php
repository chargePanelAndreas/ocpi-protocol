<?php

declare(strict_types=1);

namespace Tests\Chargemap\OCPI\Versions\V2_2_1\Server\Receiver\Tokens\Get;

use Chargemap\OCPI\Common\Server\StatusCodes\OcpiSuccessHttpCode;
use Chargemap\OCPI\Versions\V2_2_1\Common\Factories\TokenFactory;
use Chargemap\OCPI\Versions\V2_2_1\Server\Receiver\Tokens\Get\ReceiverTokenGetResponse;
use PHPUnit\Framework\TestCase;
use Tests\Chargemap\OCPI\InvalidPayloadException;
use Tests\Chargemap\OCPI\OcpiTestCase;
use Tests\Chargemap\OCPI\Versions\V2_2_1\Common\Models\TokenTest;

/**
 * @covers \Chargemap\OCPI\Versions\V2_2_1\Server\Receiver\Tokens\Get\ReceiverTokenGetResponse
 */
class ResponseConstructionTest extends TestCase
{
    public function validPayloadsProvider(): iterable
    {
        foreach (scandir(__DIR__ . '/payloads/valid/') as $filename) {
            if (!is_dir(__DIR__ . '/payloads/valid/' . $filename)) {
                yield basename($filename, '.json') => [file_get_contents(__DIR__ . '/payloads/valid/' . $filename)];
            }
        }
    }

    /**
     * @dataProvider validPayloadsProvider
     * @param string $payload
     * @throws InvalidPayloadException
     */
    public function testShouldSerializeTokenCorrectlyWithFullPayload(string $payload): void
    {
        $token = TokenFactory::fromJson(json_decode($payload));
        $response = new ReceiverTokenGetResponse($token);
        $responseInterface = $response->getResponseInterface();
        $this->assertSame(OcpiSuccessHttpCode::HTTP_OK, $responseInterface->getStatusCode());

        $json = json_decode($responseInterface->getBody()->getContents());
        OcpiTestCase::coerce('V2_2_1/Receiver/Tokens/tokenGetResponse.schema.json', $json);
        TokenTest::assertJsonSerialization($token, $json->data);
    }
}