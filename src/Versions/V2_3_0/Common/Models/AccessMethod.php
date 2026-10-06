<?php

declare(strict_types=1);

namespace Chargemap\OCPI\Versions\V2_3_0\Common\Models;

use MyCLabs\Enum\Enum;

/**
 * @method static self OPEN()
 * @method static self TOKEN()
 * @method static self LICENSE_PLATE()
 * @method static self ACCESS_CODE()
 * @method static self INTERCOM()
 * @method static self PARKING_TICKET()
 */
class AccessMethod extends Enum
{
    public const OPEN = 'OPEN';
    public const TOKEN = 'TOKEN';
    public const LICENSE_PLATE = 'LICENSE_PLATE';
    public const ACCESS_CODE = 'ACCESS_CODE';
    public const INTERCOM = 'INTERCOM';
    public const PARKING_TICKET = 'PARKING_TICKET';
}
