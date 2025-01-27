<?php

declare(strict_types=1);

namespace Tests\Chargemap\OCPI\Versions\V2_2_1\Client\Versions\GetDetails;

use Chargemap\OCPI\Common\Client\OcpiConfiguration;
use Chargemap\OCPI\Common\Client\OcpiVersion;
use Chargemap\OCPI\Versions\V2_2_1\Client\Versions\GetDetails\GetVersionDetailRequest;
use Chargemap\OCPI\Versions\V2_2_1\Client\Versions\GetDetails\GetVersionDetailService;
use Http\Client\HttpClient;
use JsonException;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ServerRequestInterface;
use Tests\Chargemap\OCPI\OcpiResponseTestCase;
use Tests\Chargemap\OCPI\Versions\V2_2_1\Common\Factories\EndpointFactoryTest;

/**
 * @covers \Chargemap\OCPI\Versions\V2_2_1\Client\Versions\GetDetails\GetVersionDetailService
 */
class GetVersionDetailServiceTest extends OcpiResponseTestCase
{
    /**
     * @var OcpiConfiguration|MockObject
     */
    private $configuration;

    /**
     * @var GetVersionDetailService|MockObject
     */
    private $service;

    public function setUp(): void
    {
        parent::setUp();

        $this->configuration = $this->createMock(OcpiConfiguration::class);

        $this->service = $this->getMockBuilder(GetVersionDetailService::class)
            ->onlyMethods(['addAuthorization'])
            ->setConstructorArgs([$this->configuration])
            ->getMock();
    }

    public function getGetData(): iterable
    {
        foreach (scandir(__DIR__ . '/Payloads/GetVersionDetailService/') as $filename) {
            if ($filename !== '.' && $filename !== '..') {
                yield $filename => [
                    'payload' => file_get_contents(__DIR__ . '/Payloads/GetVersionDetailService/' . $filename),
                ];
            }
        }
    }

    /**
     * @dataProvider getGetData
     * @param string $payload
     * @throws JsonException
     */
    public function testGet(string $payload): void
    {
        $json = json_decode($payload, false, 512, JSON_THROW_ON_ERROR);

        $serverRequestInterface = $this->createMock(ServerRequestInterface::class);

        $request = $this->createMock(GetVersionDetailRequest::class);
        $request->expects(TestCase::atLeastOnce())->method('getServerRequestInterface')->willReturn($serverRequestInterface);

        $response = $this->createResponseInterface($payload);

        // Must call the HTTP client
        $httpClient = $this->createMock(HttpClient::class);
        $httpClient->expects(TestCase::once())->method('sendRequest')->willReturn($response);

        $this->configuration->expects(TestCase::once())->method('getHttpClient')->willReturn($httpClient);

        // Must add authorization to the request
        $this->service->expects(TestCase::once())->method('addAuthorization')->with($serverRequestInterface)->willReturn($serverRequestInterface);

        $response = $this->service->get($request);

        Assert::assertEquals(OcpiVersion::fromVersionNumber($json->data->version), $response->getVersion());

        foreach ($json->data->endpoints as $index => $ocpiEndpoint) {
            EndpointFactoryTest::assertEndpoint($ocpiEndpoint, $response->getEndpoints()[$index]);
        }
    }
}
