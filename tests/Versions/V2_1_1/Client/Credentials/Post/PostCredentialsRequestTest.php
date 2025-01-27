<?php
declare(strict_types=1);

namespace Tests\Chargemap\OCPI\Versions\V2_1_1\Client\Credentials\Post;

use Chargemap\OCPI\Versions\V2_1_1\Client\Credentials\Post\PostCredentialsRequest;
use Chargemap\OCPI\Versions\V2_1_1\Common\Models\Credentials;
use Http\Discovery\Psr17FactoryDiscovery;
use JsonException;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;
use Tests\Chargemap\OCPI\InvalidPayloadException;
use Tests\Chargemap\OCPI\OcpiTestCase;

/**
 * @covers \Chargemap\OCPI\Versions\V2_1_1\Client\Credentials\Post\PostCredentialsRequest
 */
class PostCredentialsRequestTest extends TestCase
{
    public function getGetServerRequestInterfaceData(): iterable
    {
        foreach (scandir(__DIR__ . '/Payloads/PostCredentialsRequest/') as $filename) {
            if ($filename !== '.' && $filename !== '..') {
                yield $filename => [
                    'payload' => file_get_contents(__DIR__ . '/Payloads/PostCredentialsRequest/' . $filename),
                ];
            }
        }
    }

    /**
     * @dataProvider getGetServerRequestInterfaceData()
     * @throws InvalidPayloadException
     * @throws JsonException
     */
    public function testGetServerRequestInterface(string $payload): void
    {
        $json = json_decode($payload, true, 512, JSON_THROW_ON_ERROR);
        OcpiTestCase::coerce('V2_1_1/Common/credentials.schema.json', json_decode($payload));

        $credentials = $this->createMock(Credentials::class);
        $credentials->expects(TestCase::atLeastOnce())->method('jsonSerialize')->willReturn($json);

        $registerCredentialsRequest = new PostCredentialsRequest($credentials);

        $serverRequestInterface = $registerCredentialsRequest->getServerRequestInterface(Psr17FactoryDiscovery::findServerRequestFactory(), null);

        Assert::assertCount(1, $serverRequestInterface->getHeader('Content-Type'));
        Assert::assertSame('application/json; charset=utf-8', $serverRequestInterface->getHeader('Content-Type')[0]);
        self::assertJsonStringEqualsJsonString($payload, $serverRequestInterface->getBody()->getContents());
    }
}
