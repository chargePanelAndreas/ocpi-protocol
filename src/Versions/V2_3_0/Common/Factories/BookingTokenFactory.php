<?php

declare(strict_types=1);

namespace Chargemap\OCPI\Versions\V2_3_0\Common\Factories;

use Chargemap\OCPI\Versions\V2_3_0\Common\Models\BookingToken;
use Chargemap\OCPI\Versions\V2_3_0\Common\Models\TokenType;
use stdClass;

class BookingTokenFactory
{
    /**
     * @param stdClass[]|null $json
     * @return BookingToken[]|null
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

    public static function fromJson(?stdClass $json): ?BookingToken
    {
        if ($json === null) {
            return null;
        }

        $object = new BookingToken(
            $json->country_code,
            $json->party_id,
            $json->uid,
            new TokenType($json->type),
            $json->contract_id
        );

        return $object;
    }
}
