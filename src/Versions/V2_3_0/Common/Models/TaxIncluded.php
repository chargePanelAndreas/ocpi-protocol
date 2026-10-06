<?php

declare(strict_types=1);

namespace Chargemap\OCPI\Versions\V2_3_0\Common\Models;

use MyCLabs\Enum\Enum;

/**
 * @method static self YES()
 * @method static self NO()
 * @method static self NOT_APPLICABLE()
 */
class TaxIncluded extends Enum
{
    public const YES = 'YES';
    public const NO = 'NO';
    public const NOT_APPLICABLE = 'N/A';
}
