<?php

declare(strict_types=1);

namespace Chargemap\OCPI\Versions\V2_3_0\Common\Factories;

use Chargemap\OCPI\Versions\V2_3_0\Common\Models\Capability;
use Chargemap\OCPI\Versions\V2_3_0\Common\Models\EVSEStatus;
use Chargemap\OCPI\Versions\V2_3_0\Common\Models\ParkingRestriction;
use Chargemap\OCPI\Versions\V2_3_0\Common\Models\PartialEVSE;
use DateTime;
use stdClass;

class PartialEVSEFactory
{
    public static function fromJson(?stdClass $json): ?PartialEVSE
    {
        if ($json === null) {
            return null;
        }

        $evse = new PartialEVSE();

        if (property_exists($json, 'uid')) {
            $evse->withUid($json->uid);
        }
        if (property_exists($json, 'evse_id')) {
            $evse->withEvseId($json->evse_id);
        }
        if (property_exists($json, 'status')) {
            $evse->withStatus(new EVSEStatus($json->status));
        }
        if (property_exists($json, 'floor_level')) {
            $evse->withFloorLevel(FloorLevelFactory::fromString($json->floor_level));
        }
        if (property_exists($json, 'coordinates')) {
            $evse->withCoordinates(GeoLocationFactory::fromJson($json->coordinates));
        }

        if (property_exists($json, "physical_reference")) {
            $evse->withPhysicalReference(PhysicalReferenceFactory::fromString($json->physical_reference));
        }

        if (property_exists($json, 'last_updated')) {
            $evse->withLastUpdated(new DateTime($json->last_updated));
        }

        if (property_exists($json, 'status_schedule')) {
            $evse->withStatusSchedules();
            foreach ($json->status_schedule ?? [] as $jsonStatusSchedule) {
                $evse->withStatusSchedule(StatusScheduleFactory::fromJson($jsonStatusSchedule));
            }
        }

        if (property_exists($json, 'capabilities')) {
            $evse->withCapabilities();
            foreach ($json->capabilities ?? [] as $capability) {
                $evse->withCapability(new Capability($capability));
            }
        }

        if (property_exists($json, 'connectors')) {
            $evse->withConnectors();
            foreach ($json->connectors as $connector) {
                $evse->withConnector(ConnectorFactory::fromJson($connector));
            }
        }

        if (property_exists($json, 'directions')) {
            $evse->withDirections();
            foreach ($json->directions ?? [] as $direction) {
                $evse->withDirection(DisplayTextFactory::fromJson($direction));
            }
        }

        if (property_exists($json, 'parking_restrictions')) {
            $evse->withParkingRestrictions();
            foreach ($json->parking_restrictions ?? [] as $restriction) {
                $evse->withParkingRestriction(new ParkingRestriction($restriction));
            }
        }

        if (property_exists($json, 'images')) {
            $evse->withImages();
            foreach ($json->images ?? [] as $image) {
                $evse->withImage(ImageFactory::fromJson($image));
            }
        }

        if (property_exists($json, 'parking')) {
            $evse->withParking();
            foreach ($json->parking ?? [] as $parking) {
                $evse->withParkingItem(EVSEParkingFactory::fromJson($parking));
            }
        }

        if (property_exists($json, 'accepted_service_providers')) {
            $evse->withAcceptedServiceProviders();
            foreach ($json->accepted_service_providers ?? [] as $provider) {
                $evse->withAcceptedServiceProvider($provider);
            }
        }

        return $evse;
    }
}
