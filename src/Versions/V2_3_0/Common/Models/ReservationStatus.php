<?php

declare(strict_types=1);

namespace Chargemap\OCPI\Versions\V2_3_0\Common\Models;

use MyCLabs\Enum\Enum;

/**
 * @method static self PENDING()
 * @method static self RESERVED()
 * @method static self CANCELED()
 * @method static self FAILED()
 * @method static self NO_SHOW()
 * @method static self FULFILLED()
 * @method static self REJECTED()
 * @method static self UNKNOWN()
 */
class ReservationStatus extends Enum
{
    public const PENDING = 'PENDING';
    public const RESERVED = 'RESERVED';
    public const CANCELED = 'CANCELED';
    public const FAILED = 'FAILED';
    public const NO_SHOW = 'NO_SHOW';
    public const FULFILLED = 'FULFILLED';
    public const REJECTED = 'REJECTED';
    public const UNKNOWN = 'UNKNOWN';
}
