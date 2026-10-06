<?php

declare(strict_types=1);

namespace Chargemap\OCPI\Versions\V2_3_0\Common\Factories;

use Chargemap\OCPI\Versions\V2_3_0\Common\Models\Policy;
use stdClass;

class PolicyFactory
{
    /**
     * @param stdClass[]|null $json
     * @return Policy[]|null
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

    public static function fromJson(?stdClass $json): ?Policy
    {
        if ($json === null) {
            return null;
        }

        $object = new Policy(
            $json->reservation_required,
            $json->ad_hoc ?? null
        );

        return $object;
    }
}
