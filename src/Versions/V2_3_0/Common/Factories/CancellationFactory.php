<?php

declare(strict_types=1);

namespace Chargemap\OCPI\Versions\V2_3_0\Common\Factories;

use Chargemap\OCPI\Versions\V2_3_0\Common\Models\Cancellation;
use Chargemap\OCPI\Versions\V2_3_0\Common\Models\CanceledReason;
use Chargemap\OCPI\Versions\V2_3_0\Common\Models\Role;
use stdClass;

class CancellationFactory
{
    /**
     * @param stdClass[]|null $json
     * @return Cancellation[]|null
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

    public static function fromJson(?stdClass $json): ?Cancellation
    {
        if ($json === null) {
            return null;
        }

        $object = new Cancellation(
            new CanceledReason($json->cancellation_reason),
            new Role($json->who_canceled)
        );

        return $object;
    }
}
