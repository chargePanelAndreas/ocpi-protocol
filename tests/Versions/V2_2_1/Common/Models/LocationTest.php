<?php

declare(strict_types=1);

namespace Tests\Chargemap\OCPI\Versions\V2_2_1\Common\Models;

use Chargemap\OCPI\Common\Utils\DateTimeFormatter;
use Chargemap\OCPI\Versions\V2_2_1\Common\Models\Location;
use PHPUnit\Framework\Assert;
use stdClass;

/**
 * @covers \Chargemap\OCPI\Versions\V2_2_1\Common\Models\Location
 */
class LocationTest
{
    public static function assertJsonSerialization(?Location $location, ?stdClass $json): void
    {
        if ($location === null) {
            Assert::assertNull($json);
        } else {
            Assert::assertSame($location->getCountryCode(), $json->country_code);
            Assert::assertSame($location->getPartyId(), $json->party_id);
            Assert::assertSame($location->getId(), $json->id);
            Assert::assertSame($location->getPublish(), $json->publish);
            Assert::assertSame($location->getName(), $json->name);
            BusinessDetailsTest::assertJsonSerialization($location->getOperator(), $json->operator ?? null);
            BusinessDetailsTest::assertJsonSerialization($location->getOwner(), $json->owner ?? null);
            Assert::assertSame($location->getAddress(), $json->address);
            Assert::assertSame($location->getChargingWhenClosed(), $json->charging_when_closed ?? null);
            Assert::assertSame($location->getCity(), $json->city);
            GeoLocationTest::assertJsonSerialization($location->getCoordinates(), $json->coordinates);
            Assert::assertSame($location->getCountry(), $json->country);

            if (empty($location->getDirections())) {
                Assert::assertEmpty($json->directions ?? null);
            } else {
                foreach ($location->getDirections() as $index => $direction) {
                    DisplayTextTest::assertJsonSerialization($direction, $json->directions[$index]);
                }
            }

            EnergyMixTest::assertJsonSerialization($location->getEnergyMix(), $json->energy_mix ?? null);

            foreach ($location->getEvses() as $index => $evse) {
                EvseTest::assertJsonSerialization($evse, $json->evses[$index]);
            }

            if (empty($location->getFacilities())) {
                Assert::assertEmpty($json->facilities ?? null);
            } else {
                foreach ($location->getFacilities() as $index => $facility) {
                    Assert::assertSame($facility->getValue(), $json->facilities[$index]);
                }
            }

            if (empty($location->getImages())) {
                Assert::assertEmpty($json->images ?? null);
            } else {
                foreach ($location->getImages() as $index => $image) {
                    ImageTest::assertJsonSerialization($image, $json->images[$index]);
                }
            }

            Assert::assertSame(DateTimeFormatter::format($location->getLastUpdated()), $json->last_updated);
            Assert::assertSame($location->getParkingType()->getValue(), $json->parking_type);
            HoursTest::assertJsonSerialization($location->getOpeningTimes(), $json->opening_times);
            Assert::assertSame($location->getPostalCode(), $json->postal_code);

            if (empty($location->getRelatedLocations())) {
                Assert::assertEmpty($json->related_locations ?? null);
            } else {
                foreach ($location->getRelatedLocations() as $index => $image) {
                    AdditionalGeoLocationTest::assertJsonSerialization($image, $json->related_locations[$index]);
                }
            }

            BusinessDetailsTest::assertJsonSerialization($location->getSuboperator(), $json->suboperator ?? null);
            Assert::assertSame($location->getTimeZone(), $json->time_zone ?? null);
        }
    }
}
