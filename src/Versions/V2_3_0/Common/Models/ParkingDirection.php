<?php

declare(strict_types=1);

namespace Chargemap\OCPI\Versions\V2_3_0\Common\Models;

use MyCLabs\Enum\Enum;

/**
 * @method static self PARALLEL()
 * @method static self PERPENDICULAR()
 * @method static self ANGLE()
 */
class ParkingDirection extends Enum
{
    public const PARALLEL = 'PARALLEL';
    public const PERPENDICULAR = 'PERPENDICULAR';
    public const ANGLE = 'ANGLE';
}
