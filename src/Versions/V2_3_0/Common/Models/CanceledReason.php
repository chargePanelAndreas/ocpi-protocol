<?php

declare(strict_types=1);

namespace Chargemap\OCPI\Versions\V2_3_0\Common\Models;

use MyCLabs\Enum\Enum;

/**
 * @method static self POWER_OUTAGE()
 * @method static self BROKEN_CHARGER()
 * @method static self FULL()
 * @method static self BLOCKED()
 * @method static self TRAFFIC()
 * @method static self BROKEN_VEHICLE()
 * @method static self NO_CANCELED()
 * @method static self UNKNOWN()
 */
class CanceledReason extends Enum
{
    public const POWER_OUTAGE = 'POWER_OUTAGE';
    public const BROKEN_CHARGER = 'BROKEN_CHARGER';
    public const FULL = 'FULL';
    public const BLOCKED = 'BLOCKED';
    public const TRAFFIC = 'TRAFFIC';
    public const BROKEN_VEHICLE = 'BROKEN_VEHICLE';
    public const NO_CANCELED = 'NO_CANCELED';
    public const UNKNOWN = 'UNKNOWN';
}
