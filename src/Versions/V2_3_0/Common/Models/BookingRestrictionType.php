<?php

declare(strict_types=1);

namespace Chargemap\OCPI\Versions\V2_3_0\Common\Models;

use MyCLabs\Enum\Enum;

/**
 * @method static self BOOKING()
 * @method static self BOOKING_EXPIRES()
 * @method static self BOOKING_CANCELLATION_FEES()
 * @method static self BOOKING_OVERTIME()
 */
class BookingRestrictionType extends Enum
{
    public const BOOKING = 'BOOKING';
    public const BOOKING_EXPIRES = 'BOOKING_EXPIRES';
    public const BOOKING_CANCELLATION_FEES = 'BOOKING_CANCELLATION_FEES';
    public const BOOKING_OVERTIME = 'BOOKING_OVERTIME';
}
