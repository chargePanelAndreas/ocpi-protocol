<?php

declare(strict_types=1);

namespace Tests\Chargemap\OCPI\Versions\V2_3_0\Receiver\Receiver\Locations\Evses\Put;

use Chargemap\OCPI\Versions\V2_3_0\Common\Models\EVSE;
use Chargemap\OCPI\Versions\V2_3_0\Server\Receiver\Locations\Evses\Put\OcpiEmspEvsePutResponse;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Chargemap\OCPI\Versions\V2_3_0\Server\Receiver\Locations\Evses\Put\OcpiEmspEvsePutResponse
 */
class ResponseConstructionTest extends TestCase
{
    public function testDataShouldbeNull(): void
    {
        $evse = $this->createMock(EVSE::class);

        // Create response
        $response = new OcpiEmspEvsePutResponse($evse);
        $responseInterface = $response->getResponseInterface();
        $data = json_decode($responseInterface->getBody()->getContents())->data;
        $this->assertNull($data);
    }
}
