<?php

declare(strict_types=1);

namespace Chargemap\OCPI\Versions\V2_3_0\Common\Models;

use MyCLabs\Enum\Enum;

/**
 * @method static self CURRENT() 
 * @method static self ENERGY()
 * @method static self ENERGY_EXPORT()
 * @method static self ENERGY_IMPORT()
 * @method static self MAX_CURRENT()
 * @method static self MIN_CURRENT()
 * @method static self MAX_POWER()
 * @method static self MIN_POWER()
 * @method static self PARKING_TIME()
 * @method static self POWER()
 * @method static self RESERVATION_TIME()
 * @method static self RESERVATION_EXPIRES()
 * @method static self RESERVATION_OVERTIME()
 * @method static self STATE_OF_CHARGE()
 * @method static self TIME()
 */
class CdrDimensionType extends Enum
{
    public const CURRENT = 'CURRENT';
    public const ENERGY = 'ENERGY';
    public const ENERGY_EXPORT = 'ENERGY_EXPORT';
    public const ENERGY_IMPORT = 'ENERGY_IMPORT';
    public const MAX_CURRENT = 'MAX_CURRENT';
    public const MIN_CURRENT = 'MIN_CURRENT';
    public const MAX_POWER = 'MAX_POWER';
    public const MIN_POWER = 'MIN_POWER';
    public const PARKING_TIME = 'PARKING_TIME';
    public const POWER = 'POWER';
    public const RESERVATION_TIME = 'RESERVATION_TIME';
    public const RESERVATION_EXPIRES = 'RESERVATION_EXPIRES';
    public const RESERVATION_OVERTIME = 'RESERVATION_OVERTIME';
    public const STATE_OF_CHARGE = 'STATE_OF_CHARGE';
    public const TIME = 'TIME';
}
