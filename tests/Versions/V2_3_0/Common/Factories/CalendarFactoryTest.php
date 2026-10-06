<?php

declare(strict_types=1);

namespace Tests\Chargemap\OCPI\Versions\V2_3_0\Common\Factories;

use Chargemap\OCPI\Common\Utils\DateTimeFormatter;
use Chargemap\OCPI\Versions\V2_3_0\Common\Factories\CalendarFactory;
use PHPUnit\Framework\TestCase;
use Tests\Chargemap\OCPI\OcpiTestCase;

/**
 * @covers \Chargemap\OCPI\Versions\V2_3_0\Common\Factories\CalendarFactory
 */
class CalendarFactoryTest extends TestCase
{
    public function getJsonData(): iterable
    {
        foreach (scandir(__DIR__ . '/Payloads/Calendar') as $file) {
            if ($file !== '.' && $file !== '..') {
                yield $file => [file_get_contents(__DIR__ . '/Payloads/Calendar/' . $file)];
            }
        }
    }

    /**
     * @dataProvider getJsonData
     */
    public function testFromJson(string $payload): void
    {
        $json = json_decode($payload, false, 512, JSON_THROW_ON_ERROR);
        OcpiTestCase::coerce('V2_3_0/Common/bookings.schema.json#/definitions/calendar', $json);

        $model = CalendarFactory::fromJson($json);

        $this->assertEquals($json, json_decode(json_encode($model)));
    }

    public function testFromNull(): void
    {
        $this->assertNull(CalendarFactory::fromJson(null));
    }

    public function testDateTimeFormatterIsUsedForDates(): void
    {
        $json = json_decode(file_get_contents(__DIR__ . '/Payloads/Calendar/sample1.json'));
        $calendar = CalendarFactory::fromJson($json);
        $this->assertSame($json->last_updated, DateTimeFormatter::format($calendar->getLastUpdated()));
    }
}
