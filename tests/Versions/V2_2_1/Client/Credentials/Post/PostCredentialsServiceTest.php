<?php

declare(strict_types=1);

namespace Tests\Chargemap\OCPI\Versions\V2_2_1\Client\Credentials\Post;

use Chargemap\OCPI\Common\Client\OcpiConfiguration;
use Chargemap\OCPI\Versions\V2_2_1\Client\Credentials\Post\PostCredentialsRequest;
use Chargemap\OCPI\Versions\V2_2_1\Client\Credentials\Post\PostCredentialsService;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Tests\Chargemap\OCPI\OcpiResponseTestCase;
use Tests\Chargemap\OCPI\Versions\V2_2_1\Common\Factories\CredentialsFactoryTest;

/**
 * @covers \Chargemap\OCPI\Versions\V2_2_1\Client\Credentials\Post\PostCredentialsService
 */
class PostCredentialsServiceTest extends OcpiResponseTestCase
{

    /**
     * @var PostCredentialsService|MockObject
     */
    private $service;

    public function setUp(): void
    {
        parent::setUp();

        $configuration = $this->createMock(OcpiConfiguration::class);

        $this->service = $this->getMockBuilder(PostCredentialsService::class)
            ->onlyMethods(['sendRequest'])
            ->setConstructorArgs([$configuration])
            ->getMock();
    }

    public function getHandleData(): iterable
    {
        foreach (scandir(__DIR__ . '/Payloads/PostCredentialsService/') as $filename) {
            if ($filename !== '.' && $filename !== '..') {
                yield $filename => [
                    'payload' => file_get_contents(__DIR__ . '/Payloads/PostCredentialsService/' . $filename),
                ];
            }
        }
    }

    /**
     * @param string $payload
     * @dataProvider getHandleData()
     */
    public function testHandle(string $payload): void
    {
        $json = json_decode($payload, false, 512, JSON_THROW_ON_ERROR);

        $request = $this->createMock(PostCredentialsRequest::class);

        $response = $this->createResponseInterface($payload);

        $this->service->expects(TestCase::once())->method('sendRequest')->with($request)->willReturn($response);

        $result = $this->service->handle($request);

        CredentialsFactoryTest::assertCredentials($json->data, $result->getCredentials());
    }
}
