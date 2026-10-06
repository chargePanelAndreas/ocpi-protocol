<?php

declare(strict_types=1);

namespace Chargemap\OCPI\Versions\V2_3_0\Common\Models;

use Chargemap\OCPI\Common\Models\OpenEnum;

/**
 * @method static self MOTORCYCLE()
 * @method static self PERSONAL_VEHICLE()
 * @method static self PERSONAL_VEHICLE_WITH_TRAILER()
 * @method static self VAN()
 * @method static self SEMI_TRACTOR()
 * @method static self RIGID()
 * @method static self TRUCK_WITH_TRAILER()
 * @method static self BUS()
 * @method static self DISABLED()
 */
class VehicleType extends OpenEnum
{
    public const MOTORCYCLE = 'MOTORCYCLE';
    public const PERSONAL_VEHICLE = 'PERSONAL_VEHICLE';
    public const PERSONAL_VEHICLE_WITH_TRAILER = 'PERSONAL_VEHICLE_WITH_TRAILER';
    public const VAN = 'VAN';
    public const SEMI_TRACTOR = 'SEMI_TRACTOR';
    public const RIGID = 'RIGID';
    public const TRUCK_WITH_TRAILER = 'TRUCK_WITH_TRAILER';
    public const BUS = 'BUS';
    public const DISABLED = 'DISABLED';
}
