<?php

declare(strict_types=1);

namespace Tests\Chargemap\OCPI\Versions\V2_2_1\Server\Common\Credentials\Get;

use Chargemap\OCPI\Versions\V2_2_1\Common\Factories\CredentialsFactory;
use Chargemap\OCPI\Versions\V2_2_1\Server\Common\Credentials\Get\OcpiEmspCredentialsGetResponse;
use PHPUnit\Framework\TestCase;
use Tests\Chargemap\OCPI\OcpiTestCase;
use Tests\Chargemap\OCPI\Versions\V2_2_1\Common\Models\CredentialsTest;

/**
 * @covers \Chargemap\OCPI\Versions\V2_2_1\Server\Common\Credentials\Get\OcpiEmspCredentialsGetResponse
 */
class ResponseConstructionTest extends TestCase
{
    public function testShouldConstructCorrectly(): void
    {
        $credentials = CredentialsFactory::fromJson(json_decode(file_get_contents(__DIR__ . '/payloads/CredentialsPayload.json')));
        $response = new OcpiEmspCredentialsGetResponse($credentials, 'Message!');
        $responseInterface = $response->getResponseInterface();
        $json = json_decode($responseInterface->getBody()->getContents());
        OcpiTestCase::coerce('V2_2_1/Common/Credentials/credentialsPostResponse.schema.json', $json);
        CredentialsTest::assertJsonSerialize($credentials, $json->data);
    }
}
