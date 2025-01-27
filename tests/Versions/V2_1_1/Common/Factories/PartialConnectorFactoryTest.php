<?php

namespace Tests\Chargemap\OCPI\Versions\V2_1_1\Common\Factories;

use Chargemap\OCPI\Versions\V2_1_1\Common\Factories\PartialConnectorFactory;
use Chargemap\OCPI\Versions\V2_1_1\Common\Models\PartialConnector;
use DateTime;
use JsonException;
use PHPUnit\Framework\TestCase;
use stdClass;
use Tests\Chargemap\OCPI\InvalidPayloadException;
use Tests\Chargemap\OCPI\OcpiTestCase;

/**
 * @covers \Chargemap\OCPI\Versions\V2_1_1\Common\Factories\PartialConnectorFactory
 */
class PartialConnectorFactoryTest extends TestCase
{
    public function getFromJsonData(): iterable
    {
        foreach (scandir(__DIR__ . '/Payloads/PartialConnector/') as $filename) {
            if ($filename !== '.' && $filename !== '..') {
                yield $filename => [
                    'payload' => file_get_contents(__DIR__ . '/Payloads/PartialConnector/' . $filename),
                ];
            }
        }
    }

    /**
     * @param string $payload
     * @throws JsonException|InvalidPayloadException
     * @dataProvider getFromJsonData()
     */
    public function testFromJson(string $payload): void
    {
        $json = json_decode($payload, false, 512, JSON_THROW_ON_ERROR);

        OcpiTestCase::coerce('V2_1_1/eMSP/Locations/Evses/Connectors/connectorPatchRequest.schema.json', $json);

        $connector = PartialConnectorFactory::fromJson($json);

        self::assertPartialConnector($json, $connector);
    }

    public static function assertPartialConnector(?stdClass $json, PartialConnector $connector)
    {
        if (property_exists($json, 'id')) {
            self::assertTrue($connector->hasId());
            self::assertSame($json->id, $connector->getId());
        } else {
            self::assertFalse($connector->hasId());
        }
        if (property_exists($json, 'standard')) {
            self::assertTrue($connector->hasStandard());
            self::assertSame($json->standard, $connector->getStandard()->getValue());
        } else {
            self::assertFalse($connector->hasStandard());
        }
        if (property_exists($json, 'format')) {
            self::assertTrue($connector->hasFormat());
            self::assertSame($json->format, $connector->getFormat()->getValue());
        } else {
            self::assertFalse($connector->hasFormat());
        }
        if (property_exists($json, 'power_type')) {
            self::assertTrue($connector->hasPowerType());
            self::assertSame($json->power_type, $connector->getPowerType()->getValue());
        } else {
            self::assertFalse($connector->hasPowerType());
        }
        if (property_exists($json, 'max_voltage')) {
            self::assertTrue($connector->hasMaxVoltage());
            self::assertSame($json->max_voltage, $connector->getMaxVoltage());
        } else {
            self::assertFalse($connector->hasMaxVoltage());
        }
        if (property_exists($json, 'max_amperage')) {
            self::assertTrue($connector->hasMaxAmperage());
            self::assertSame($json->max_amperage, $connector->getMaxAmperage());
        } else {
            self::assertFalse($connector->hasMaxAmperage());
        }
        if (property_exists($json, 'max_electric_power')) {
            self::assertTrue($connector->hasMaxElectricPower());
            self::assertSame($json->max_electric_power, $connector->getMaxElectricPower());
        } else {
            self::assertFalse($connector->hasMaxElectricPower());
        }
        if (property_exists($json, 'tariff_id')) {
            self::assertTrue($connector->hasTariffId());
            self::assertSame($json->tariff_id, $connector->getTariffId());
        } else {
            self::assertFalse($connector->hasTariffId());
        }
        if (property_exists($json, 'terms_and_conditions')) {
            self::assertTrue($connector->hasTermsAndConditions());
            self::assertSame($json->terms_and_conditions, $connector->getTermsAndConditions());
        } else {
            self::assertFalse($connector->hasTermsAndConditions());
        }
        if (property_exists($json, 'last_updated')) {
            self::assertTrue($connector->hasLastUpdated());
            self::assertEquals(new DateTime($json->last_updated), $connector->getLastUpdated());
        } else {
            self::assertFalse($connector->hasLastUpdated());
        }
    }
}
