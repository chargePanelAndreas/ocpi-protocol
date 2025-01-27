<?php
declare(strict_types=1);

namespace Tests\Chargemap\OCPI\Versions\V2_2_1\Client\Versions\GetDetails;

use Chargemap\OCPI\Common\Client\OcpiVersion;
use Chargemap\OCPI\Common\Models\VersionEndpoint;
use Chargemap\OCPI\Versions\V2_2_1\Client\Versions\GetDetails\GetVersionDetailRequest;
use Http\Discovery\Psr17FactoryDiscovery;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ServerRequestFactoryInterface;

/**
 * @covers \Chargemap\OCPI\Versions\V2_2_1\Client\Versions\GetDetails\GetVersionDetailRequest
 */
class GetVersionDetailRequestTest extends TestCase
{
    public function testGetServerRequestInterface()
    {
        $uriFactory = Psr17FactoryDiscovery::findUriFactory();

        $request = new GetVersionDetailRequest(new VersionEndpoint(
            OcpiVersion::V2_2_1(),
            $uriFactory->createUri('http://example.com')
        ));

        $serverRequestFactory = $this->createMock(ServerRequestFactoryInterface::class);
        // Must create a GET request on the provided url
        $serverRequestFactory->expects(TestCase::once())->method('createServerRequest')->with('GET', 'http://example.com');

        $request->getServerRequestInterface($serverRequestFactory);
    }
}
