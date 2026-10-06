<?php

declare(strict_types=1);

namespace Chargemap\OCPI\Versions\V2_3_0\Common\Models;

use MyCLabs\Enum\Enum;

/**
 * @method static self LEFT()
 * @method static self RIGHT()
 * @method static self CENTER()
 */
class EVSEPosition extends Enum
{
    public const LEFT = 'LEFT';
    public const RIGHT = 'RIGHT';
    public const CENTER = 'CENTER';
}
