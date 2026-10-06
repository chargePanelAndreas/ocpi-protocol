<?php

declare(strict_types=1);

namespace Chargemap\OCPI\Versions\V2_3_0\Common\Factories;

use Chargemap\OCPI\Versions\V2_3_0\Common\Models\PriceLimit;
use stdClass;

class PriceLimitFactory
{
    public static function fromJson(?stdClass $json): ?PriceLimit
    {
        if ($json === null) {
            return null;
        }

        return new PriceLimit($json->before_taxes, $json->after_taxes ?? null);
    }
}

