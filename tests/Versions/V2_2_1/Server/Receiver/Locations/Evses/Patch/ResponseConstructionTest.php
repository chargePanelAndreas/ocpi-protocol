<?php

declare(strict_types=1);

namespace Tests\Chargemap\OCPI\Versions\V2_2_1\Server\Receiver\Locations\Evses\Patch;

use Chargemap\OCPI\Versions\V2_2_1\Common\Models\PartialEVSE;
use Chargemap\OCPI\Versions\V2_2_1\Server\Receiver\Locations\Evses\Patch\OcpiEmspEvsePatchResponse;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Chargemap\OCPI\Versions\V2_2_1\Server\Receiver\Locations\Evses\Patch\OcpiEmspEvsePatchResponse
 */
class ResponseConstructionTest extends TestCase
{
    public function testDataShouldBeNull(): void
    {
        $partialEvse = $this->createMock(PartialEVSE::class);

        // Create response
        $response = new OcpiEmspEvsePatchResponse($partialEvse);
        $responseInterface = $response->getResponseInterface();
        $data = json_decode($responseInterface->getBody()->getContents())->data;
        $this->assertNull($data);
    }
}
