<?php

declare(strict_types=1);

namespace Chargemap\OCPI\Versions\V2_3_0\Common\Models;

use MyCLabs\Enum\Enum;

/**
 * @method static self ACCEPTED()
 * @method static self NOT_SUPPORTED()
 * @method static self REJECTED()
 * @method static self TOO_OFTEN()
 * @method static self UNKNOWN_SESSION()
 */
class ChargingProfileResponseType extends Enum
{
    public const ACCEPTED = 'ACCEPTED';
    public const NOT_SUPPORTED = 'NOT_SUPPORTED';
    public const REJECTED = 'REJECTED';
    public const TOO_OFTEN = 'TOO_OFTEN';
    public const UNKNOWN_SESSION = 'UNKNOWN_SESSION';
}
