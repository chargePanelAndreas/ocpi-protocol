<?php

declare(strict_types=1);

namespace Tests\Chargemap\OCPI\Versions\V2_2_1\Server\Receiver\Locations\Evses\Connectors\Patch;

use Chargemap\OCPI\Versions\V2_2_1\Common\Models\PartialConnector;
use Chargemap\OCPI\Versions\V2_2_1\Server\Receiver\Locations\Evses\Connectors\Patch\OcpiEmspConnectorPatchResponse;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Chargemap\OCPI\Versions\V2_2_1\Server\Receiver\Locations\Evses\Connectors\Patch\OcpiEmspConnectorPatchResponse
 */
class ResponseConstructionTest extends TestCase
{
    public function testDataShouldBeNull(): void
    {
        $partialConnector = $this->createMock(PartialConnector::class);

        // Create response
        $response = new OcpiEmspConnectorPatchResponse($partialConnector);
        $responseInterface = $response->getResponseInterface();
        $data = json_decode($responseInterface->getBody()->getContents())->data;
        $this->assertNull($data);
    }
}
