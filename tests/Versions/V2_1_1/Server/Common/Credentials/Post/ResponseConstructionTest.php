<?php

declare(strict_types=1);

namespace Tests\Chargemap\OCPI\Versions\V2_1_1\Server\Common\Credentials\Post;

use Chargemap\OCPI\Versions\V2_1_1\Common\Factories\CredentialsFactory;
use Chargemap\OCPI\Versions\V2_1_1\Server\Common\Credentials\Post\OcpiCredentialsPostResponse;
use PHPUnit\Framework\TestCase;
use Tests\Chargemap\OCPI\OcpiTestCase;
use Tests\Chargemap\OCPI\Versions\V2_1_1\Common\Models\CredentialsTest;

/**
 * @covers \Chargemap\OCPI\Versions\V2_1_1\Server\Common\Credentials\Post\OcpiCredentialsPostResponse
 */
class ResponseConstructionTest extends TestCase
{
    public function testShouldConstructCorrectly(): void
    {
        $credentials = CredentialsFactory::fromJson(json_decode(file_get_contents(__DIR__ . '/payloads/valid/CredentialsPayload.json')));
        $response = new OcpiCredentialsPostResponse($credentials, 'Message!');
        $responseInterface = $response->getResponseInterface();
        $this->assertSame(201, $responseInterface->getStatusCode());
        $json = json_decode($responseInterface->getBody()->getContents());
        OcpiTestCase::coerce('V2_1_1/Common/Credentials/credentialsPostResponse.schema.json', $json);
        CredentialsTest::assertJsonSerialize($credentials, $json->data);
    }
}
