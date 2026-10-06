<?php
declare(strict_types=1);

namespace Chargemap\OCPI\Versions\V2_3_0\Common\Factories;

use Chargemap\OCPI\Versions\V2_3_0\Common\Models\CdrDimension;
use Chargemap\OCPI\Versions\V2_3_0\Common\Models\CdrDimensionType;
use stdClass;

class CdrDimensionFactory
{
    public static function fromJson(?stdClass $json): ?CdrDimension
    {
        if ($json === null) {
            return null;
        }

        return new CdrDimension(
            new CdrDimensionType($json->type),
            $json->volume
        );
    }
}