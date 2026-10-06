<?php
declare(strict_types=1);

namespace Chargemap\OCPI\Versions\V2_3_0\Common\Factories;

use Chargemap\OCPI\Versions\V2_3_0\Common\Models\Location;
use Chargemap\OCPI\Versions\V2_3_0\Common\Models\LocationReferences;
use stdClass;

class LocationReferencesFactory
{
    public static function fromJson(?stdClass $json): ?LocationReferences
    {
        if ($json === null) {
            return null;
        }

        $result = new LocationReferences($json->location_id);

        if (property_exists($json, 'evse_uids') && is_array($json->evse_uids)) {
            foreach ($json->evse_uids as $evseUid) {
                $result->addEvseUid($evseUid);
            }
        }

        return $result;
    }
}