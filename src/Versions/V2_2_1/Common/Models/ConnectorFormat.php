<?php

declare(strict_types=1);

namespace Chargemap\OCPI\Versions\V2_2_1\Common\Models;

use MyCLabs\Enum\Enum;

/**
 * @method static self SOCKET()
 * @method static self CABLE()
 */
class ConnectorFormat extends Enum
{
    public const SOCKET = 'SOCKET';
    public const CABLE = 'CABLE';
}
