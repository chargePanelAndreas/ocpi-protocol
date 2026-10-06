<?php

declare(strict_types=1);

namespace Tests\Chargemap\OCPI\Versions\V2_3_0\Client\Generic;

use Chargemap\OCPI\Versions\V2_3_0\Client\Generic\JsonRequest;
use Chargemap\OCPI\Versions\V2_3_0\Client\Generic\JsonService;
use Chargemap\OCPI\Versions\V2_3_0\Common\Factories\ClientInfoFactory;
use Chargemap\OCPI\Versions\V2_3_0\Common\Factories\TerminalFactory;
use Chargemap\OCPI\Versions\V2_3_0\Common\Models\ClientInfo;
use Chargemap\OCPI\Versions\V2_3_0\Common\Models\ModuleId;
use Chargemap\OCPI\Versions\V2_3_0\Common\Models\Terminal;
use Http\Discovery\Psr17FactoryDiscovery;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;

/**
 * @covers \Chargemap\OCPI\Versions\V2_3_0\Client\Generic\JsonRequest
 * @covers \Chargemap\OCPI\Versions\V2_3_0\Client\Generic\JsonResponse
 * @covers \Chargemap\OCPI\Versions\V2_3_0\Client\Generic\JsonService
 */
class JsonServiceTest extends TestCase
{
    private const FIXTURES = __DIR__ . '/../../Common/Factories/Payloads/';

    private function response(string $body, array $headers = []): ResponseInterface
    {
        $response = Psr17FactoryDiscovery::findResponseFactory()->createResponse()
            ->withHeader('Content-Type', 'application/json')
            ->withBody(Psr17FactoryDiscovery::findStreamFactory()->createStream($body));
        foreach ($headers as $name => $value) {
            $response = $response->withHeader($name, $value);
        }
        return $response;
    }

    private function envelope($data): string
    {
        return json_encode([
            'data' => $data,
            'status_code' => 1000,
            'timestamp' => '2024-01-01T00:00:00Z',
        ]);
    }

    private function service(JsonRequest $request, ResponseInterface $response): JsonService
    {
        $service = $this->getMockBuilder(JsonService::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['sendRequest'])
            ->getMock();
        $service->expects($this->once())->method('sendRequest')->with($request)->willReturn($response);
        return $service;
    }

    public function testRequestIsBuiltCorrectly(): void
    {
        $body = TerminalFactory::fromJson(json_decode(file_get_contents(self::FIXTURES . 'Terminal/sample1.json')));
        $request = new JsonRequest(ModuleId::PAYMENTS(), 'PUT', '/terminals/abc', $body, ['foo' => 'bar', 'skip' => null]);

        $psr = $request->getServerRequestInterface(Psr17FactoryDiscovery::findServerRequestFactory(), null);

        self::assertSame('PUT', $psr->getMethod());
        self::assertSame('/terminals/abc', $psr->getUri()->getPath());
        self::assertSame('foo=bar', $psr->getUri()->getQuery());
        self::assertSame('application/json', $psr->getHeaderLine('Content-Type'));
        self::assertEquals(
            json_decode(file_get_contents(self::FIXTURES . 'Terminal/sample1.json')),
            json_decode($psr->getBody()->getContents())
        );
        self::assertSame('payments', $request->getModule()->getValue());
        self::assertTrue($request->getVersion()->equals(\Chargemap\OCPI\Common\Client\OcpiVersion::V2_3_0()));
    }

    public function testListingRequestAddsLimitAndOffset(): void
    {
        $request = (new JsonRequest(ModuleId::HUB_CLIENT_INFO(), 'GET'))->withOffset(10)->withLimit(5);
        $psr = $request->getServerRequestInterface(Psr17FactoryDiscovery::findServerRequestFactory(), null);

        self::assertSame('offset=10&limit=5', $psr->getUri()->getQuery());
    }

    public function testObject(): void
    {
        $json = file_get_contents(self::FIXTURES . 'Terminal/sample1.json');
        $request = new JsonRequest(ModuleId::PAYMENTS(), 'GET', '/terminals/abc');
        $service = $this->service($request, $this->response($this->envelope(json_decode($json))));

        $response = $service->object(
            $request,
            'V2_3_0/Sender/Payments/terminalGetResponse.schema.json',
            static fn($data) => TerminalFactory::fromJson($data)
        );

        self::assertInstanceOf(Terminal::class, $response->getData());
        self::assertEquals(json_decode($json), json_decode(json_encode($response->getData())));
    }

    public function testListingWithNextPage(): void
    {
        $json = json_decode(file_get_contents(self::FIXTURES . 'ClientInfo/sample1.json'));
        $request = new JsonRequest(ModuleId::HUB_CLIENT_INFO(), 'GET');
        $link = '<https://example.com/ocpi/hubclientinfo?offset=1&limit=1>; rel="next"';
        $service = $this->service($request, $this->response($this->envelope([$json]), ['Link' => $link]));

        $response = $service->listing(
            $request,
            'V2_3_0/Sender/HubClientInfo/clientInfoGetListingResponse.schema.json',
            null,
            static fn($data) => ClientInfoFactory::fromJson($data)
        );

        self::assertCount(1, $response->getItems());
        self::assertInstanceOf(ClientInfo::class, $response->getItems()[0]);
        self::assertNotNull($response->getNextRequest());
        self::assertSame(1, $response->getNextRequest()->getOffset());
        self::assertSame(1, $response->getNextRequest()->getLimit());
    }

    public function testListingWithoutNextPage(): void
    {
        $request = new JsonRequest(ModuleId::HUB_CLIENT_INFO(), 'GET');
        $service = $this->service($request, $this->response($this->envelope([])));

        $response = $service->listing(
            $request,
            'V2_3_0/Sender/HubClientInfo/clientInfoGetListingResponse.schema.json',
            null,
            static fn($data) => ClientInfoFactory::fromJson($data)
        );

        self::assertSame([], $response->getItems());
        self::assertNull($response->getNextRequest());
    }

    public function testStatus(): void
    {
        $request = new JsonRequest(ModuleId::PAYMENTS(), 'POST', '/terminals/abc/deactivate');
        $service = $this->service($request, $this->response($this->envelope(null)));

        self::assertSame(200, $service->status($request)->getResponseInterface()->getStatusCode());
    }

    public function testStatusThrowsOnServerError(): void
    {
        $request = new JsonRequest(ModuleId::PAYMENTS(), 'POST', '/terminals/abc/deactivate');
        $service = $this->service($request, $this->response('{}')->withStatus(500));

        $this->expectException(\Chargemap\OCPI\Common\Server\Errors\OcpiGenericClientError::class);
        $service->status($request);
    }
}


