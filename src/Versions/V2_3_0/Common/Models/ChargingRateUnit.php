<?php

declare(strict_types=1);

namespace Chargemap\OCPI\Versions\V2_3_0\Common\Models;

use MyCLabs\Enum\Enum;

/**
 * @method static self W()
 * @method static self A()
 */
class ChargingRateUnit extends Enum
{
    public const W = 'W';
    public const A = 'A';
}
