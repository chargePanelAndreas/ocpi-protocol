<?php

declare(strict_types=1);

namespace Chargemap\OCPI\Versions\V2_3_0\Common\Factories;

use Chargemap\OCPI\Versions\V2_3_0\Common\Models\ClientInfo;
use Chargemap\OCPI\Versions\V2_3_0\Common\Models\ConnectionStatus;
use Chargemap\OCPI\Versions\V2_3_0\Common\Models\Role;
use DateTime;
use stdClass;

class ClientInfoFactory
{
    /**
     * @param stdClass[]|null $json
     * @return ClientInfo[]|null
     */
    public static function arrayFromJsonArray(?array $json): ?array
    {
        if ($json === null) {
            return null;
        }

        $objects = [];
        foreach ($json as $jsonObject) {
            $objects[] = self::fromJson($jsonObject);
        }

        return $objects;
    }

    public static function fromJson(?stdClass $json): ?ClientInfo
    {
        if ($json === null) {
            return null;
        }

        $object = new ClientInfo(
            $json->party_id,
            $json->country_code,
            new Role($json->role),
            new ConnectionStatus($json->status),
            new DateTime($json->last_updated)
        );

        return $object;
    }
}
