<?php

declare(strict_types=1);

namespace Chargemap\OCPI\Versions\V2_3_0\Common\Models;

use MyCLabs\Enum\Enum;

/**
 * @method static self CPO()
 * @method static self EMSP()
 * @method static self NSP()
 * @method static self NAP()
 * @method static self OTHER()
 * @method static self SCSP()
 */
class Role extends Enum
{
    public const CPO = 'CPO';
    public const EMSP = 'EMSP';
    public const NSP = 'NSP';
    public const NAP = 'NAP';
    public const OTHER = 'OTHER';
    public const SCSP = 'SCSP';
}
