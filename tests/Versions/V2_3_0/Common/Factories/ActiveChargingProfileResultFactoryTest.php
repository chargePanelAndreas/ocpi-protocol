<?php

declare(strict_types=1);

namespace Tests\Chargemap\OCPI\Versions\V2_3_0\Common\Factories;

use Chargemap\OCPI\Versions\V2_3_0\Common\Factories\ActiveChargingProfileResultFactory;
use PHPUnit\Framework\TestCase;
use Tests\Chargemap\OCPI\OcpiTestCase;

/**
 * @covers \Chargemap\OCPI\Versions\V2_3_0\Common\Factories\ActiveChargingProfileResultFactory
 */
class ActiveChargingProfileResultFactoryTest extends TestCase
{
    public function getJsonData(): iterable
    {
        foreach (scandir(__DIR__ . '/Payloads/ActiveChargingProfileResult') as $file) {
            if ($file !== '.' && $file !== '..') {
                yield $file => [file_get_contents(__DIR__ . '/Payloads/ActiveChargingProfileResult/' . $file)];
            }
        }
    }

    /**
     * @dataProvider getJsonData
     */
    public function testFromJson(string $payload): void
    {
        $json = json_decode($payload, false, 512, JSON_THROW_ON_ERROR);
        OcpiTestCase::coerce('V2_3_0/Common/charging_profiles.schema.json#/definitions/active_charging_profile_result', $json);

        $model = ActiveChargingProfileResultFactory::fromJson($json);

        $this->assertEquals($json, json_decode(json_encode($model)));
    }

    public function testFromNull(): void
    {
        $this->assertNull(ActiveChargingProfileResultFactory::fromJson(null));
    }
}
