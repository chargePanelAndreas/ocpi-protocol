<?php

declare(strict_types=1);

namespace Chargemap\OCPI\Versions\V2_3_0\Common\Models;

use Chargemap\OCPI\Common\Models\OpenEnum;

/**
 * @method static self CHARGER()
 * @method static self ENTRANCE()
 * @method static self LOCATION()
 * @method static self NETWORK()
 * @method static self OPERATOR()
 * @method static self OTHER()
 * @method static self OWNER()
 */
class ImageCategory extends OpenEnum
{
    public const CHARGER = 'CHARGER';
    public const ENTRANCE = 'ENTRANCE';
    public const LOCATION = 'LOCATION';
    public const NETWORK = 'NETWORK';
    public const OPERATOR = 'OPERATOR';
    public const OTHER = 'OTHER';
    public const OWNER = 'OWNER';
}
