<?php

declare(strict_types=1);

namespace Chargemap\OCPI\Versions\V2_3_0\Common\Models;

use MyCLabs\Enum\Enum;

/**
 * @method static self CPO()
 * @method static self PTP()
 */
class InvoiceCreator extends Enum
{
    public const CPO = 'CPO';
    public const PTP = 'PTP';
}
