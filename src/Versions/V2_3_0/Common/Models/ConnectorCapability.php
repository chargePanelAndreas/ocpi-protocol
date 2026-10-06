<?php

declare(strict_types=1);

namespace Chargemap\OCPI\Versions\V2_3_0\Common\Models;

use Chargemap\OCPI\Common\Models\OpenEnum;

/**
 * @method static self ISO_15118_2_PLUG_AND_CHARGE()
 * @method static self ISO_15118_20_PLUG_AND_CHARGE()
 */
class ConnectorCapability extends OpenEnum
{
    public const ISO_15118_2_PLUG_AND_CHARGE = 'ISO_15118_2_PLUG_AND_CHARGE';
    public const ISO_15118_20_PLUG_AND_CHARGE = 'ISO_15118_20_PLUG_AND_CHARGE';
}
