<?php

declare(strict_types=1);

namespace Tests\Chargemap\OCPI\Versions\V2_3_0\Common\Factories;

use Chargemap\OCPI\Versions\V2_3_0\Common\Factories\PartialBookingFactory;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Chargemap\OCPI\Versions\V2_3_0\Common\Factories\PartialBookingFactory
 */
class PartialBookingFactoryTest extends TestCase
{
    public function testFromJson(): void
    {
        $json = json_decode('{"reservation_status":"CANCELED","canceled":{"cancellation_reason":"TRAFFIC","who_canceled":"EMSP"},"last_updated":"2026-01-01T00:00:00.000Z"}');
        $partial = PartialBookingFactory::fromJson($json);

        $this->assertTrue($partial->hasReservationStatus());
        $this->assertTrue($partial->hasCanceled());
        $this->assertTrue($partial->hasLastUpdated());
        $this->assertFalse($partial->hasPeriod());
        $this->assertEquals($json, json_decode(json_encode($partial)));
    }

    public function testFromNull(): void
    {
        $this->assertNull(PartialBookingFactory::fromJson(null));
    }
}
