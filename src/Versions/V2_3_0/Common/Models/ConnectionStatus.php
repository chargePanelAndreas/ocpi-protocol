<?php

declare(strict_types=1);

namespace Chargemap\OCPI\Versions\V2_3_0\Common\Models;

use MyCLabs\Enum\Enum;

/**
 * @method static self CONNECTED()
 * @method static self OFFLINE()
 * @method static self PLANNED()
 * @method static self SUSPENDED()
 */
class ConnectionStatus extends Enum
{
    public const CONNECTED = 'CONNECTED';
    public const OFFLINE = 'OFFLINE';
    public const PLANNED = 'PLANNED';
    public const SUSPENDED = 'SUSPENDED';
}
