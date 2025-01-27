<?php

declare(strict_types=1);

namespace Tests\Chargemap\OCPI\Versions\V2_2_1\Server\Receiver\Locations\Evses\Connectors\Get;

use Chargemap\OCPI\Versions\V2_2_1\Server\Receiver\Locations\Evses\Connectors\Get\OcpiEmspConnectorGetRequest;
use Chargemap\OCPI\Versions\V2_2_1\Server\Receiver\Locations\LocationRequestParams;
use InvalidArgumentException;
use Tests\Chargemap\OCPI\OcpiTestCase;

/**
 * @covers \Chargemap\OCPI\Versions\V2_2_1\Server\Receiver\Locations\Evses\Connectors\Get\OcpiEmspConnectorGetRequest
 */
class RequestConstructionTest extends OcpiTestCase
{
    public function testShouldFailWithoutConnectorId(): void
    {
        $serverRequestInterface = $this->createServerRequestInterface();

        $this->expectException(InvalidArgumentException::class);
        new OcpiEmspConnectorGetRequest($serverRequestInterface, new LocationRequestParams('EN', 'PID', 'locationId', 'evseUid'));
    }

    public function testShouldConstructWithValidRequest(): void
    {
        $serverRequestInterface = $this->createServerRequestInterface();

        $request = new OcpiEmspConnectorGetRequest($serverRequestInterface,
            new LocationRequestParams('EN', 'PID', 'locationId', 'evseUid', 'connectorId'));
        $this->assertInstanceOf(OcpiEmspConnectorGetRequest::class, $request);
        $this->assertEquals('connectorId', $request->getConnectorId());
    }
}
