<?php

declare(strict_types=1);

namespace Tests\Chargemap\OCPI\Versions\V2_3_0\Common;

use PHPUnit\Framework\TestCase;
use Tests\Chargemap\OCPI\InvalidPayloadException;
use Tests\Chargemap\OCPI\OcpiTestCase;

/**
 * Schema level checks of the timestamp definition and of the charging preferences wrappers.
 */
class TimestampAndChargingPreferencesSchemaTest extends TestCase
{
    public function validTimestamps(): iterable
    {
        foreach ([
            '2015-06-29T20:39:09Z',
            '2015-06-29T20:39:09',
            '2016-12-29T17:45:09.2Z',
            '2016-12-29T17:45:09.2',
            '2018-01-01T01:08:01.123Z',
            '2018-01-01T01:08:01.123',
        ] as $value) {
            yield $value => [$value];
        }
    }

    public function invalidTimestamps(): iterable
    {
        foreach ([
            '2026-00-00T24:00:00',
            '2026-13-01T00:00:00Z',
            '2026-01-32T00:00:00Z',
            '2026-01-01T24:00:00Z',
            '2026-01-01T00:60:00Z',
            '2026-01-01T00:00:00+01:00',
            '2026-01-01',
            'garbage',
        ] as $value) {
            yield $value => [$value];
        }
    }

    private function chargingPeriod(string $start): \stdClass
    {
        return (object)[
            'start_date_time' => $start,
            'dimensions' => [(object)['type' => 'ENERGY', 'volume' => 1.5]],
        ];
    }

    /**
     * @dataProvider validTimestamps
     */
    public function testValidTimestampsAreAccepted(string $value): void
    {
        OcpiTestCase::coerce('V2_3_0/Common/common.schema.json#/definitions/charging_period', $this->chargingPeriod($value));
        $this->addToAssertionCount(1);
    }

    /**
     * @dataProvider invalidTimestamps
     */
    public function testInvalidTimestampsAreRejected(string $value): void
    {
        $this->expectException(InvalidPayloadException::class);
        OcpiTestCase::coerce('V2_3_0/Common/common.schema.json#/definitions/charging_period', $this->chargingPeriod($value));
    }

    public function testInvalidResponseTimestampIsRejected(): void
    {
        $this->expectException(InvalidPayloadException::class);
        OcpiTestCase::coerce('V2_3_0/Sender/Sessions/sessionPutResponse.schema.json', (object)[
            'data' => 'ACCEPTED',
            'status_code' => 1000,
            'timestamp' => '2026-00-00T24:00:00',
        ]);
    }

    public function testChargingPreferencesPutRequestSchema(): void
    {
        OcpiTestCase::coerce('V2_3_0/Sender/Sessions/sessionPutRequest.schema.json', (object)[
            'profile_type' => 'GREEN',
            'departure_time' => '2026-01-01T10:00:00',
            'energy_need' => 20,
        ]);
        $this->addToAssertionCount(1);
    }

    public function testChargingPreferencesPutRequestRequiresProfileType(): void
    {
        $this->expectException(InvalidPayloadException::class);
        OcpiTestCase::coerce('V2_3_0/Sender/Sessions/sessionPutRequest.schema.json', (object)['energy_need' => 20]);
    }

    public function testChargingPreferencesPutRequestRejectsBadDepartureTime(): void
    {
        $this->expectException(InvalidPayloadException::class);
        OcpiTestCase::coerce('V2_3_0/Sender/Sessions/sessionPutRequest.schema.json', (object)[
            'profile_type' => 'GREEN',
            'departure_time' => 'garbage',
        ]);
    }

    public function testChargingPreferencesPutResponseSchema(): void
    {
        OcpiTestCase::coerce('V2_3_0/Sender/Sessions/sessionPutResponse.schema.json', (object)[
            'data' => 'ACCEPTED',
            'status_code' => 1000,
            'timestamp' => '2026-01-01T10:00:00Z',
        ]);
        $this->addToAssertionCount(1);
    }

    public function testChargingPreferencesPutResponseRejectsUnknownValue(): void
    {
        $this->expectException(InvalidPayloadException::class);
        OcpiTestCase::coerce('V2_3_0/Sender/Sessions/sessionPutResponse.schema.json', (object)[
            'data' => 'MAYBE',
            'status_code' => 1000,
            'timestamp' => '2026-01-01T10:00:00Z',
        ]);
    }
}


