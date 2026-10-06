<?php

declare(strict_types=1);

namespace Chargemap\OCPI\Versions\V2_3_0\Common\Models;

use MyCLabs\Enum\Enum;

/**
 * @method static self ACCEPTED()
 * @method static self REJECTED()
 * @method static self UNKNOWN()
 */
class ChargingProfileResultType extends Enum
{
    public const ACCEPTED = 'ACCEPTED';
    public const REJECTED = 'REJECTED';
    public const UNKNOWN = 'UNKNOWN';
}
