<?php

declare(strict_types=1);

namespace Chargemap\OCPI\Versions\V2_3_0\Common\Factories;

use Chargemap\OCPI\Versions\V2_3_0\Common\Models\AccessInformation;
use Chargemap\OCPI\Versions\V2_3_0\Common\Models\AccessMethod;
use stdClass;

class AccessInformationFactory
{
    /**
     * @param stdClass[]|null $json
     * @return AccessInformation[]|null
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

    public static function fromJson(?stdClass $json): ?AccessInformation
    {
        if ($json === null) {
            return null;
        }

        $object = new AccessInformation(
            new AccessMethod($json->method),
            $json->value ?? null
        );

        return $object;
    }
}
