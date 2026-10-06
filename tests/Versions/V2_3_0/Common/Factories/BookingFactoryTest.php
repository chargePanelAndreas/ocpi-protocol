<?php

declare(strict_types=1);

namespace Tests\Chargemap\OCPI\Versions\V2_3_0\Common\Factories;

use Chargemap\OCPI\Versions\V2_3_0\Common\Factories\BookingFactory;
use PHPUnit\Framework\TestCase;
use Tests\Chargemap\OCPI\OcpiTestCase;

/**
 * @covers \Chargemap\OCPI\Versions\V2_3_0\Common\Factories\BookingFactory
 */
class BookingFactoryTest extends TestCase
{
    public function getJsonData(): iterable
    {
        foreach (scandir(__DIR__ . '/Payloads/Booking') as $file) {
            if ($file !== '.' && $file !== '..') {
                yield $file => [file_get_contents(__DIR__ . '/Payloads/Booking/' . $file)];
            }
        }
    }

    /**
     * @dataProvider getJsonData
     */
    public function testFromJson(string $payload): void
    {
        $json = json_decode($payload, false, 512, JSON_THROW_ON_ERROR);
        OcpiTestCase::coerce('V2_3_0/Common/bookings.schema.json#/definitions/booking', $json);

        $model = BookingFactory::fromJson($json);

        $this->assertEquals($json, json_decode(json_encode($model)));
    }

    public function testFromNull(): void
    {
        $this->assertNull(BookingFactory::fromJson(null));
    }
}
