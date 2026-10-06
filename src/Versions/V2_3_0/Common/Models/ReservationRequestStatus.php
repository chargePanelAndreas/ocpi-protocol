<?php

declare(strict_types=1);

namespace Chargemap\OCPI\Versions\V2_3_0\Common\Models;

use MyCLabs\Enum\Enum;

/**
 * @method static self PENDING()
 * @method static self ACCEPTED()
 * @method static self DECLINED()
 * @method static self FAILED()
 */
class ReservationRequestStatus extends Enum
{
    public const PENDING = 'PENDING';
    public const ACCEPTED = 'ACCEPTED';
    public const DECLINED = 'DECLINED';
    public const FAILED = 'FAILED';
}
