<?php

declare(strict_types=1);

namespace Chargemap\OCPI\Versions\V2_3_0\Common\Models;

use Chargemap\OCPI\Common\Models\OpenEnum;

/**
 * @method static self EV_ONLY()
 * @method static self PLUGGED()
 * @method static self DISABLED()
 * @method static self CUSTOMERS()
 * @method static self MOTORCYCLES()
 * @method static self EMPLOYEES()
 * @method static self TAXIS()
 * @method static self TENANTS()
 */
class ParkingRestriction extends OpenEnum
{
    public const EV_ONLY = 'EV_ONLY';
    public const PLUGGED = 'PLUGGED';
    public const DISABLED = 'DISABLED';
    public const CUSTOMERS = 'CUSTOMERS';
    public const MOTORCYCLES = 'MOTORCYCLES';
    public const EMPLOYEES = 'EMPLOYEES';
    public const TAXIS = 'TAXIS';
    public const TENANTS = 'TENANTS';
}
