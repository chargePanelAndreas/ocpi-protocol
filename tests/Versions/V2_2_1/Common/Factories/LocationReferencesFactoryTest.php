<?php
declare(strict_types=1);

namespace Tests\Chargemap\OCPI\Versions\V2_2_1\Common\Factories;

use Chargemap\OCPI\Versions\V2_2_1\Common\Factories\LocationReferencesFactory;
use Chargemap\OCPI\Versions\V2_2_1\Common\Models\LocationReferences;
use JsonException;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;
use stdClass;
use Tests\Chargemap\OCPI\InvalidPayloadException;
use Tests\Chargemap\OCPI\OcpiTestCase;

class LocationReferencesFactoryTest extends TestCase
{
    public function getFromJsonData(): iterable
    {
        foreach (scandir(__DIR__ . '/Payloads/LocationReferences/') as $filename) {
            if ($filename !== '.' && $filename !== '..') {
                yield $filename => [
                    'payload' => file_get_contents(__DIR__ . '/Payloads/LocationReferences/' . $filename),
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

        OcpiTestCase::coerce('V2_2_1/Common/common.schema.json#/definitions/location_references', $json );

        $location = LocationReferencesFactory::fromJson($json);

        self::assertLocationReferences($json, $location);
    }

    public static function assertLocationReferences(?stdClass $json, ?LocationReferences $locationReferences): void
    {
        if($json === null ) {
            Assert::assertNull($locationReferences);
        } else {

            Assert::assertSame($json->location_id, $locationReferences->getLocationId());

            if(!property_exists($json, 'evse_uids') || $json->evse_uids === null) {
                Assert::assertSame(0, count($locationReferences->getEvseUids()));
            } else {
                foreach($json->evse_uids as $index => $evseUid ) {
                    Assert::assertSame($json->evse_uids[$index], $locationReferences->getEvseUids()[$index]);
                }
            }
        }
    }
}