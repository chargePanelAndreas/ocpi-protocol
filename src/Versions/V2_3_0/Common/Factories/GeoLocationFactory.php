<?php

declare(strict_types=1);

namespace Chargemap\OCPI\Versions\V2_3_0\Common\Factories;

use Chargemap\OCPI\Versions\V2_3_0\Common\Models\GeoLocation;
use stdClass;

class GeoLocationFactory
{
    public static function fromJson(?stdClass $json): ?GeoLocation
    {
        if($json === null) {
            return null;
        }

        return new GeoLocation(
            $json->latitude,
            $json->longitude
        );
    }
}