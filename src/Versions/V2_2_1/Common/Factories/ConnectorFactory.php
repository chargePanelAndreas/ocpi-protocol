<?php

declare(strict_types=1);

namespace Chargemap\OCPI\Versions\V2_2_1\Common\Factories;

use Chargemap\OCPI\Versions\V2_2_1\Common\Models\Connector;
use Chargemap\OCPI\Versions\V2_2_1\Common\Models\ConnectorFormat;
use Chargemap\OCPI\Versions\V2_2_1\Common\Models\ConnectorType;
use Chargemap\OCPI\Versions\V2_2_1\Common\Models\PowerType;
use DateTime;
use stdClass;

class ConnectorFactory
{
    public static function fromJson(?stdClass $json): ?Connector
    {
        if ($json === null) {
            return null;
        }

        $connector = new Connector(
            $json->id,
            new ConnectorType($json->standard),
            new ConnectorFormat($json->format),
            new PowerType($json->power_type),
            $json->max_voltage,
            $json->max_amperage,
            $json->max_electric_power ?? null,
            property_exists($json, 'terms_and_conditions') ? $json->terms_and_conditions : null,
            new DateTime($json->last_updated)
        );

        if (property_exists($json, 'tariff_ids') && $json->tariff_ids !== null) {
            foreach ($json->tariff_ids as $tariffId) {
                $connector->addTariffId($tariffId);
            }
        }

        return $connector;
    }
}
