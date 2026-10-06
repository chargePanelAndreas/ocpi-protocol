<?php

declare(strict_types=1);

namespace Chargemap\OCPI\Versions\V2_3_0\Common\Models;

use Chargemap\OCPI\Common\Models\OpenEnum;

/**
 * @method static self NUCLEAR_WASTE()
 * @method static self CARBON_DIOXIDE()
 */
class EnvironmentalImpactCategory extends OpenEnum
{
    public const NUCLEAR_WASTE = 'NUCLEAR_WASTE';
    public const CARBON_DIOXIDE = 'CARBON_DIOXIDE';
}
