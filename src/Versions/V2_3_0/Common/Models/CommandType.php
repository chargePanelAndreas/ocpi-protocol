<?php

declare(strict_types=1);

namespace Chargemap\OCPI\Versions\V2_3_0\Common\Models;

use Chargemap\OCPI\Common\Models\OpenEnum;

/**
 * @method static self CANCEL_RESERVATION()
 * @method static self RESERVE_NOW()
 * @method static self START_SESSION()
 * @method static self STOP_SESSION()
 * @method static self UNLOCK_CONNECTOR()
 */
class CommandType extends OpenEnum
{
    public const CANCEL_RESERVATION = 'CANCEL_RESERVATION';
    public const RESERVE_NOW = 'RESERVE_NOW';
    public const START_SESSION = 'START_SESSION';
    public const STOP_SESSION = 'STOP_SESSION';
    public const UNLOCK_CONNECTOR = 'UNLOCK_CONNECTOR';
}
