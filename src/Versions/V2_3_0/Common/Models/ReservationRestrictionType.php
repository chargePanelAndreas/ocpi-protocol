<?php

declare(strict_types=1);

namespace Chargemap\OCPI\Versions\V2_3_0\Common\Models;

use MyCLabs\Enum\Enum;

/**
 * @method static self RESERVATION()
 * @method static self RESERVATION_EXPIRES()
 */
class ReservationRestrictionType extends Enum
{
    public const RESERVATION = 'RESERVATION';
    public const RESERVATION_EXPIRES = 'RESERVATION_EXPIRES';
}