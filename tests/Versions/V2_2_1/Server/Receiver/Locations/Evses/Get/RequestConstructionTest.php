<?php

declare(strict_types=1);

namespace Tests\Chargemap\OCPI\Versions\V2_2_1\Server\Receiver\Locations\Evses\Get;

use Chargemap\OCPI\Versions\V2_2_1\Server\Receiver\Locations\Evses\Get\OcpiEmspEvseGetRequest;
use Chargemap\OCPI\Versions\V2_2_1\Server\Receiver\Locations\LocationRequestParams;
use InvalidArgumentException;
use Tests\Chargemap\OCPI\OcpiTestCase;

/**
 * @covers \Chargemap\OCPI\Versions\V2_2_1\Server\Receiver\Locations\Evses\Get\OcpiEmspEvseGetRequest
 */
class RequestConstructionTest extends OcpiTestCase
{
    public function testShouldFailWithoutEvseUid(): void
    {
        $serverRequestInterface = $this->createServerRequestInterface();

        $this->expectException(InvalidArgumentException::class);
        new OcpiEmspEvseGetRequest($serverRequestInterface, new LocationRequestParams('EN', 'PID', 'locationId'));
    }

    public function testShouldConstructWithValidRequest(): void
    {
        $serverRequestInterface = $this->createServerRequestInterface();

        $request = new OcpiEmspEvseGetRequest($serverRequestInterface, new LocationRequestParams('EN', 'PID', 'locationId', 'evseUid'));
        $this->assertInstanceOf(OcpiEmspEvseGetRequest::class, $request);
        $this->assertEquals('evseUid', $request->getEvseUid());
    }
}
