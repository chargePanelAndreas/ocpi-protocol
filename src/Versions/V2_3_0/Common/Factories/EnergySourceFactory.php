<?php
declare(strict_types=1);

namespace Chargemap\OCPI\Versions\V2_3_0\Common\Factories;

use Chargemap\OCPI\Versions\V2_3_0\Common\Models\EnergySource;
use Chargemap\OCPI\Versions\V2_3_0\Common\Models\EnergySourceCategory;
use stdClass;

class EnergySourceFactory
{
    public static function fromJson(?stdClass $source): ?EnergySource
    {
        if($source === null ) {
            return null;
        }

        return new EnergySource(
            new EnergySourceCategory($source->source),
            $source->percentage
        );
    }
}